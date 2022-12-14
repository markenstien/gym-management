<?php 

    class InstructorPackageModel extends Model
    {
        public $table = 'instructor_packages';
        public $_fillables = [
            'package_name',
            'program_id',
            'price',
            'sessions',
            'is_active'
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
                "SELECT package.*, program_name FROM {$this->table} as package
                    LEFT JOIN instructor_programs as programs
                    ON programs.id = package.program_id
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