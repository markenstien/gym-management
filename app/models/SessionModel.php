<?php 

    class SessionModel extends Model
    {
        public $table = 'sessions';

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])) {
                $where = " WHERE " . parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']} ";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT {$params['limit']} ";
            }

            $this->db->query(
                "SELECT * FROM v_sessions
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }

        public function get($id) {
            if(is_array($id)) {
                $id = parent::conditionConvert($id);
            } else {
                $id = " id = {$id}";
            }
            
            return $this->getAll([
                'where' => $id
            ])[0] ?? false;
        }

        public function addSessionTaken($sessionId) {
            $session = parent::get($sessionId);
            
            if(timeDifference($session->last_update, today()) <= 24) {
                $this->addError("Session is already used a while ago!");
                return false;
            }
            if($session->package_session <=  $session->session_taken){
                $this->addError("Session already completed!");
                return false;
            }

            $sessionTaken = $session->session_taken + 1;
            
            return parent::update([
                'session_taken' => $sessionTaken,
                'last_update' => nowMilitary()
            ], $sessionId);
        }

        public function updateDailySession() {
            $dateToday = nowMilitary();
            $dateYesterDay = date('Y-m-d H:i:s', strtotime('-1 day'.$dateToday));

            /**
             * get daily packages
             * search sessions with daily package which are not updated within 24 hours
             * update each session
             * update daily packages
             */
            $dailyPackages = "SELECT id,auto_last_update from instructor_packages
            WHERE consume_type = 'daily'";

            $this->db->query($dailyPackages);

            $dailyPackages = $this->db->resultSet();

            if($dailyPackages) {
                $packagesId = [];
                foreach($dailyPackages as $key => $row) {
                    $packagesId[] = $row->id;
                }

                //select sessions within 24 hours
                $sql = "SELECT * FROM {$this->table}
                    WHERE package_id in (".implode(',', $packagesId).")
                        AND package_session > session_taken";

                $this->db->query($sql);
                $sessions = $this->db->resultSet();

                foreach($sessions as $key => $row) {
                    if(timeDifference($row->last_update, $dateToday) >= 24) {
                        parent::update([
                            'session_taken' => ($row->session_taken + 1),
                            'last_update'   =>  $dateToday,
                        ], $row->id);
                    }
                }

                $sql = "UPDATE instructor_packages
                    SET auto_last_update = '{$dateToday}'
                    WHERE id in(".implode(',', $packagesId).") ";

                $this->db->query($sql);
                $this->db->execute();
            }
        }
    }