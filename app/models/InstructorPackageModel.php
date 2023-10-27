<?php 

    class InstructorPackageModel extends Model
    {
        public $table = 'instructor_packages';
        public $_fillables = [
            'package_name',
            'program_id',
            'price',
            'sessions',
            'is_active',
            'is_member',
            'is_instructed'
        ];

        public function createOrUpdate($data, $id = null) {
            
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;

            if(isset($params['where'])) {
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if(isset($params['order'])) {
                $order = " ORDER BY {$params['order']}";
            }
            
            $this->db->query(
                "SELECT *, if(is_member, 'Member', 'Non-Member') is_member_text,
                    if(is_instructed, 'Instructed', 'Non-Instructed') is_instructed_text FROM {$this->table} as package
                    {$where} {$order}"
            );

            return $this->db->resultSet();
        }

        public function get($id) {
            return $this->getAll([
                'where' => [
                    'package.id' => $id
                ]
            ])[0] ?? false;
        }
    }