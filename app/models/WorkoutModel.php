<?php
    class WorkoutModel extends Model
    {
        public $table = 'workouts';

        public $_fillables = [
            'workout_name',
            'workout_tag',
        ];

        public function add($workOutdata) {
            $_fillables = parent::getFillablesOnly($workOutdata);
            return parent::store($_fillables);
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])){
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])){
                $order = " ORDER BY {$params['order']} ";
            }

            if(!empty($params['limit'])){
                $limit = " LIMIT BY {$params['limit']} ";
            }

            $this->db->query(
                "SELECT * FROM {$this->table}
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }