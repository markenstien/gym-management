<?php 

    class UserProgramModel extends Model
    {
        public $table = 'user_programs';
        public $_fillables = [
            'user_id',
            'program_id',
            'package_id',
            'sessions',
            'is_cancelled',
            'instructor_id'
        ];

        public function createOrUpdate($data, $id = null) {
            $_fillables = parent::getFillablesOnly($data);

            if(!is_null($id)) {
                $retVal = parent::update($_fillables, $id);
                $this->addMessage("User Program Updated");
            } else {
                $retVal = parent::store($_fillables);
                $this->addMessage("User Program Created");
            }
            return $retVal;
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;

            if(isset($params['where'])) {
                $where = " WHERE ". parent::conditionConvert($params['where']);
            }

            if(isset($params['order'])) {
                $order = " ORDER BY {$params['order']}";
            }

            $this->db->query(
                "SELECT user_program.*, package_name, program_name, package.sessions as sessions,
                    user_program.created_at as program_start_date,
                    CONCAT(instructor.firstname, ' ',instructor.lastname) as instructor_name,
                    CONCAT(member.firstname, ' ',member.lastname) as member_name,
                    member.user_identification as user_identification,
                    member.id as member_id
                    FROM {$this->table} as user_program
                    
                LEFT JOIN instructor_packages as package
                ON package.id = user_program.package_id
                
                LEFT JOIN instructor_programs as program
                ON program.id = user_program.program_id
                
                LEFT JOIN users as instructor
                on instructor.id = user_program.instructor_id

                LEFT JOIN users as member
                on member.id = user_program.user_id
                {$where}  {$order}"
            );

            return $this->db->resultSet();
        }
    }