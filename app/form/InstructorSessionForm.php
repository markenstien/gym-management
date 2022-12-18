<?php
    namespace Form;

    use Core\Form;
use Database;

    load(['Form'], CORE);

    class InstructorSessionForm extends Form
    {
        public function __construct()
        {
            parent::__construct();
            parent::init([
                'url' => _route('instructor-session:create')
            ]);
            $this->addInstructor();
            $this->addSessionName();
            $this->addProgramId();
            $this->addStartDate();
            $this->addStartTime();
            $this->addStatus();

            $this->customSubmit('Save Session');
        }

        public function addInstructor() {
            $this->add([
                'type' => 'hidden',
                'name' => 'instructor_id'
            ]);
        }

        public function addSessionName() {
            $this->add([
                'type' => 'text',
                'name' => 'session_name',
                'options' => [
                    'label' => 'Session Name'
                ],
                'class' => 'form-control',
                'required' => true
            ]);
        }

        public function addStartDate() {
            $this->add([
                'type' => 'date',
                'name' => 'start_date',
                'options' => [
                    'label' => 'Start Date'
                ],
                'class' => 'form-control',
                'required' => true
            ]);
        }

        public function addStartTime() {
            $this->add([
                'type' => 'time',
                'name' => 'start_time',
                'options' => [
                    'label' => 'Start Time'
                ],
                'class' => 'form-control',
                'required' => true
            ]);
        }

        public function addProgramId() {
            $db = Database::getInstance();

            $db->query(
                "SELECT * FROM instructor_programs"
            );
            $programs = $db->resultSet();

            $this->add([
                'type' => 'select',
                'name' => 'program_id',
                'options' => [
                    'label' => 'Start Time',
                    'option_values' => arr_layout_keypair($programs, ['id', 'program_name'])
                ],
                'class' => 'form-control',
                'required' => true
            ]);
        }

        public function addStatus() {
            $this->add([
                'type' => 'select',
                'name' => 'status',
                'options' => [
                    'label' => 'Start Time',
                    'option_values' => [
                        'pending', 'cancelled', 'completed'
                    ]
                ],
                'class' => 'form-control',
                'required' => true
            ]);
        }
    }