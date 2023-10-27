<?php 

    class ProgramModel extends Model
    {
        public $table = 'programs';
        public $programSessionModel;
        public $_fillables = [
            'program_name',
            'program_code',
            'package_id',
            'start_date',
            'description',
            'instructor_id',
            'status',
            'sessions',
            'program_amount',
        ];

        private $instructorPackageModel;
        public function addNew($programData) {
            $programDataFillables = parent::getFillablesOnly($programData);
            $programCode = $this->_generateCode();

            if(!empty($programData['package_id'])) {
                if(!isset($this->instructorPackageModel)) {
                    $this->instructorPackageModel = model('InstructorPackageModel');
                }
                $package = $this->instructorPackageModel->get($programData['package_id']);

                if(!$package) {
                    $this->addError("Package no longer exists");
                    return false;
                }
                $programDataFillables['program_code'] = $programCode;
                $programDataFillables['sessions'] = $package->sessions;
                $programDataFillables['program_amount'] = $package->price;
                $programDataFillables['status'] = 'pending';

                $programId = parent::store($programDataFillables);
                $this->_autoCreateProgramSessions($programId);

                return $programId;
            } else {
                $this->addError("You must set package to creaate new program");
                return false;
            }
        }

        public function get($id) {

            if(is_string($id)) {
                $id = [
                    'program.id' => $id
                ];
            }
            return $this->getAll([
                'where' => $id
            ])[0] ?? false;
        }

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])) {
                $where = " WHERE " .parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {params['order']} ";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT {$params['limit']} ";
            }

            $this->db->query(
                "SELECT program.*, package_name, ip.sessions, ip.sessions as package_session,
                    ip.price as package_price, concat(firstname , ' ', lastname) as instructor_name,
                    ifnull(ppt.total, 0) as attendee_total
                    FROM {$this->table} as program
                    LEFT JOIN instructor_packages as ip
                        ON program.package_id = ip.id
                    LEFT JOIN users as instructor
                        ON program.instructor_id = instructor.id 
                    LEFT JOIN program_participants_total as ppt
                        ON ppt.program_id = program.id
                        
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }

        public function getParticipants($programId) {
            if(!isset($this->participantModel)) {
                $this->participantModel = model('ProgramParticipantModel');
            }

            return $this->participantModel->getAll([
                'where' => [
                    'program_id' => $programId
                ]
            ]);
        }

        public function getSessions($programId) {
            if(!isset($this->programSessionModel)) {
                $this->programSessionModel = model('ProgramSessionModel');
            }
            
            return $this->programSessionModel->all([
                'program_id' => $programId
            ], 'FIELD(status, "ongoing", "completed")');
        }
        private function _generateCode() {
            return random_number(5);
        }

        private function _autoCreateProgramSessions($programId) {
            $program = $this->get($programId);
            $programSession = $program->sessions;

            if(!isset($this->programSessionModel)) {
                $this->programSessionModel = model('ProgramSessionModel');
            }

            $sessionDate = $program->start_date;

            for($i = 0 ; $i < $programSession; $i++) {
                $this->programSessionModel->store([
                    'program_id' => $programId,
                    'session_date' => $sessionDate,
                    'status' => 'ongoing'
                ]);
                $sessionDate = date('Y-m-d', strtotime($sessionDate . '+2 days'));
            }
        }
    }