<?php 

    class WorkoutSetBuilderModel extends Model
    {
        public $table = 'workout_sets';
        public $_fillables = [
            'set_name',
            'set_tag',
            'schedule',
            'user_id',
            'last_set_taken'
        ];

        public function add($setBuilderData) {
            $_fillables = parent::getFillablesOnly($setBuilderData);
            return parent::store($_fillables);
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            $dayName = date('D'); //short

            if(!empty($params['where'])) {
                $where = " WHERE ". parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']} ";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT BY {$params['limit']} ";
            }
            $this->db->query(
                "SELECT ws.*, concat(user.firstname, ' ', user.lastname) as user_fullname,
                    if(ws.schedule = '{$dayName}', 'yes', 'no') as schedule_text
                    FROM {$this->table} as ws
                    LEFT JOIN users as user 
                        ON user.id = ws.user_id
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }