<?php 

    class WorkoutSetItemModel extends Model
    {
        public $table = 'workout_set_items';
        public $_fillables = [
            'workout_set_id',
            'workout_id',
            'rep_count',
            'work_time_hr',
            'work_time_min',
            'work_time_sec',
            'rest_time_hr',
            'rest_time_sec',
            'is_completed',
            'last_set_item_taken',
        ];

        public function add($setItemData) {
            $_fillables = parent::getFillablesOnly($setItemData);
            return parent::store($_fillables);
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])) {
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER {$params['order']} ";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT {$params['limit']} ";
            }

            $dateToday = today();

            $this->db->query(
                "SELECT wsi.*, workout.workout_name,
                    workout.workout_tag,
                    if(DATE_FORMAT(wsi.last_set_item_taken, '%Y-%m-%d') = '{$dateToday}', 'Complete Today' , 'Pending') as is_complete_text
                    FROM {$this->table} as wsi
                    LEFT JOIN workouts as workout
                        ON workout.id = wsi.workout_id
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }

        public function get($id) {
            if(is_array($id)) {
                return $this->getAll([
                    'where' => $id
                ])[0] ?? false;
            } else {
                return $this->getAll([
                    'where' => [
                        'wsi.id' => $id
                    ]
                ])[0] ?? false;
            }
        }
    }