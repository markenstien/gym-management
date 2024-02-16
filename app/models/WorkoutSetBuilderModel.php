<?php 

    class WorkoutSetBuilderModel extends Model
    {
        public $table = 'workout_sets';
        public $_fillables = [
            'set_name',
            'set_tag',
            'schedule',
            'user_id',
            'last_set_taken',
            'is_public',
            'is_assigned_to'
        ];

        public function add($setBuilderData) {
            $_fillables = parent::getFillablesOnly($setBuilderData);
            $workout = $this->get([
                'schedule' => $setBuilderData['schedule'],
                'user_id' => $setBuilderData['user_id']
            ]);

            if($workout) {
                $this->addError("Workout for that schedule is already created.");
                return false;
            }
            return parent::store($_fillables);
        }

        public function get($id){
            if(is_array($id)) {
                return $this->getAll([
                    'where' => $id
                ])[0] ?? false;
            } else {
                return $this->getAll([
                    'where' => [
                        'ws.id' => $id
                    ]
                ])[0] ?? false;
            }
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
            } else {
                $order = " ORDER BY FIELD(schedule, 'Sun','Mon','Tue','Wed','Thu','Fri','Sat')";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT BY {$params['limit']} ";
            }
            $this->db->query(
                "SELECT ws.*, concat(user.firstname, ' ', user.lastname) as user_fullname,
                    concat(assigned_to_user.firstname, ' ', assigned_to_user.lastname) as assigned_to_full_name,
                    if(ws.schedule = '{$dayName}', 'yes', 'no') as schedule_text,
                    if((ws.is_set_complete = true) && (ws.schedule = '{$dayName}'), 'Completed', 'Pending') as is_complete_text
                    FROM {$this->table} as ws
                    LEFT JOIN users as user 
                        ON user.id = ws.user_id
                    LEFT JOIN users as assigned_to_user
                        ON assigned_to_user.id = ws.is_assigned_to
                        
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }

        public function complete($id) {
            return parent::update([
                'is_set_complete' => true,
                'last_set_taken'  => today()
            ], $id);
        }
    }