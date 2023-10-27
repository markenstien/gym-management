<?php 

    class ProgramParticipantModel extends Model
    {
        public $table = 'program_participants';
        public $_fillables = [
            'program_id',
            'member_id',
            'session_taken',
            'payments',
            'status'
        ];


        public function addNew($participantData) {
            $participantDataValid = parent::getFillablesOnly($participantData);

            if(parent::single([
                'program_id' => $participantDataValid['program_id'],
                'member_id'  => $participantDataValid['member_id']
            ])) {
                $this->addError("User is already participating the program, add new participant failed.");
                return false;
            }
            return parent::store($participantDataValid);
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])) {
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']}";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT BY {$params['limit']} ";
            }

            $this->db->query(
                "SELECT *,ifnull(sessions_taken,0) as sessions_taken FROM v_program_participants 
                    {$where} {$order} {$limit}"
            );
            
            
            // $this->db->query(
            //     "SELECT pp.*, ifnull(pp.sessions_taken, 0) as sessions_taken,  member.user_identification,
            //         member.firstname, member.lastname,
            //         concat(member.firstname ,  ' ' ,member.lastname) as member_name,
            //         program.program_name, program.program_code,
            //         program.start_date as program_start_date,
            //         program.status as program_status,
            //         package_name, ip.sessions as package_session
            //         FROM {$this->table} as pp

            //         LEFT JOIN users as member
            //         ON pp.member_id = member.id
                    
            //         LEFT JOIN programs as program
            //         ON program.id = pp.program_id
                    
            //         LEFT JOIN instructor_packages as ip
            //         ON program.package_id = ip.id
                    
            //         {$where} {$order} {$limit}"
            // );

            return $this->db->resultSet();
        }

        public function addSession($sessionData) {
            $session = parent::single([
                'program_id' => $sessionData['program_id'],
                'member_id'  => $sessionData['member_id']
            ]);

            $sessionsTaken = $session->sessions_taken + 1;
            
            return parent::update([
                'sessions_taken' => $sessionsTaken
            ], $session->id);
        }
    }