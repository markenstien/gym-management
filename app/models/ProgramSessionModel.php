<?php 

    class ProgramSessionModel extends Model
    {
        public $table = 'program_sessions';
        private $userModel,$programParticipantModel;

        public function get($id) {
            $session = parent::get($id);
            $attendees = json_decode($session->attendees, true);
            $session->attendees = $attendees;

            return $session;
        }

        public function complete($data) {

            if(empty($data['attendees'])) {
                $this->addError("No attendees found");
                return false;
            }

            $attendeeJson = [];

            if(!isset($this->userModel)) {
                $this->userModel = model('UserModel');
            }

            if(!isset($this->programParticipantModel)) {
                $this->programParticipantModel = model('ProgramParticipantModel');
            }

            $attendees = $this->userModel->getAll([
                'where' => [
                    'id' => [
                        'condition' => 'in',
                        'value' => $data['attendees']
                    ]
                ]
            ]);

            if($attendees) {
                foreach($attendees as $key => $row) {
                    $attendeeJson[] = [
                        'id' => $row->id,
                        'username' => $row->username,
                        'firstname' => $row->firstname,
                        'lastname'  => $row->lastname,
                        'name'      => $row->firstname . ' ' .$row->lastname,
                        'user_identification' => $row->user_identification
                    ];

                    $this->programParticipantModel->addSession([
                        'program_id' => $data['program_id'],
                        'member_id'  => $row->id
                    ]);
                }
            }

            return parent::update([
                'attendees' => json_encode($attendeeJson),
                'status'    => 'completed',
                'remarks'   => $data['remarks']
            ], $data['session_id']);
        }
    }