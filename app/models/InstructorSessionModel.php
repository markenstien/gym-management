<?php 

    class InstructorSessionModel extends Model
    {
        public $table = 'instructor_sessions';
        
        public $_fillables = [
            'instructor_id',
            'session_name',
            'start_date',
            'start_time',
            'program_id',
            'package_id',
            'status',
            'created_by'
        ];

        public function createOrUpdate($data, $id = null) {
            $_fillables = parent::getFillablesOnly($data);

            if(!is_null($id)) {
                $retVal = parent::update($_fillables, $id);
            } else {
                $retVal = parent::store($_fillables);
            }
            
            return $retVal;
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $group = null;

            if (!empty($params['where'])) {
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if (!empty($params['order'])) {
                $order  = " ORDER BY {$params['order']}";
            }

            if (!empty($params['group'])) {
                $group = " GROUP BY {$params['group']}";
            }



            $this->db->query(
                "SELECT ins.*,
                    concat(instructor.firstname, ' ',instructor.lastname) as instructor_name,
                    package_name, isa.user_id as user_id
                    FROM {$this->table} as ins 
                        LEFT JOIN users as instructor
                        ON instructor.id = ins.instructor_id
                    
                        LEFT JOIN instructor_packages as package
                        ON package.id = ins.program_id

                        LEFT JOIN instructor_session_attendees as isa
                        ON isa.instructor_session_id = ins.id
                    
                    {$where} {$group} {$order}"
            );

            return $this->db->resultSet();
        }

        public function get($id) {
            return $this->getAll([
                'where' => [
                    'ins.id' => $id
                ]
            ])[0] ?? false;
        }

        public function addAttendee($id, $memberId) {

            $isExist = $this->dbHelper->single('instructor_session_attendees','*', parent::conditionConvert([
                'instructor_session_id' => $id,
                'user_id' => $memberId
            ]));

            if($isExist) {
                $this->addError("Member already in session");
                return false;
            }
            //check if member already eeixsts
            $isOkay = $this->dbHelper->insert('instructor_session_attendees', [
                'instructor_session_id' => $id,
                'user_id' => $memberId
            ]);

            if($isOkay) {
                $this->addMessage("Attendee added");
                return true;
            }else{
                $this->addError("Un-able to add member");
                return false;
            }
        }

        public function removeAttendee($id) {
            return $this->dbHelper->delete('instructor_session_attendees', parent::conditionConvert([
                'id' => $id
            ]));
        }

        public function getAttendees($params = []){
            
            $where = null;
            $order = null;

            if(!empty($params['where'])) {
                $where = " WHERE ". parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']}";
            }

            $this->db->query(
                "SELECT attendees.*, concat(member.firstname, ' ',member.lastname) as member_name ,
                    member.user_identification, 
                    member.gender as member_gender,
                    instructor.gender as instructor_gender,
                    package_name, sessions.session_name,
                    sessions.start_date,sessions.start_time,
                    sessions.status as status,
                    concat(instructor.firstname, ' ',instructor.lastname) as instructor_name,
                    
                    CASE 
                        WHEN user_confirmation is null THEN 'Pending'
                        ELSE user_confirmation
                        end as is_accepted

                    FROM instructor_session_attendees as attendees

                    LEFT JOIN {$this->table} as sessions 
                    ON sessions.id = attendees.instructor_session_id

                    LEFT JOIN users as member 
                    ON member.id = attendees.user_id

                    LEFT JOIN users as instructor 
                    ON instructor.id = sessions.instructor_id
                    
                    LEFT JOIN instructor_packages as package 
                    on package.id = sessions.program_id
                        {$where} {$order}"
            );

            return $this->db->resultSet();
        }

        public function complete($id) {
            return parent::update(['status' => 'completed'], $id);
        }

        public function cancel($id) {
            return parent::update(['status' => 'cancelled'], $id);
        }

        /**
         * attendee id*
         */
        public function accept($id) {
            return $this->dbHelper->update(...[
                'instructor_session_attendees',
                [
                    'user_confirmation' => nowMilitary()
                ],
                parent::conditionConvert(['id' => $id])
            ]);
        }
    }