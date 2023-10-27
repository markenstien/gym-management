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
            $sessionTaken = $session->session_taken + 1;

            if($session->package_session <=  $sessionTaken){
                $this->addError("Session already completed!");
                return false;
            }
            
            return parent::update([
                'session_taken' => $sessionTaken
            ], $sessionId);
        }
    }