<?php 

    class RegularSessionModel extends Model
    {
        public $table = 'regular_sessions';

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;
            
            if(!empty($params['where'])) {
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']} ";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT {$params['limit']} ";
            }

            $this->db->query(
                "SELECT * FROM v_regular_sessions
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }