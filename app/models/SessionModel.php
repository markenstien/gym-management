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

            $autoUpdatePackage = "SELECT id from instructor_packages
            WHERE consume_type = 'daily'
            AND date(auto_last_update) <= date('{$dateYesterDay}')";
            $this->db->query($autoUpdatePackage);

            $packagesToUpdate = $this->db->resultSet();

            if($packagesToUpdate) {
                $packagesId = [];
                    foreach($packagesToUpdate as $key => $row) {
                        $packagesId[] = $row->id;
                    }

                    $packagesId = implode(',', $packagesId);
                    //update session
                    $sql = "
                        UPDATE {$this->table} 
                            SET session_taken = (session_taken + 1),
                            last_update = '{$dateToday}'
                            WHERE package_id in($packagesId);
                    ";
                    $this->db->query($sql);
                    $this->db->execute();


                //update packages
                $sql = "UPDATE instructor_packages
                    SET auto_last_update = '{$dateToday}'
                    WHERE id in($packagesId) ";

                $this->db->query($sql);
                $this->db->execute();
            }
            
        }
    }