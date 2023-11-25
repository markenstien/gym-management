<?php

    class WorkoutSetSessionModel extends Model
    {
        public $table = 'workout_sessions';
        public $_fillables = [
            'user_id',
            'schedule',
            'session_date'
        ];

        public function addSession($sessionData) {
            $session = parent::single([
                'user_id' => $sessionData['user_id'],
                'schedule' => $sessionData['schedule']
            ]);

            if($session) {
                $this->addError("Session is already in placed");
                return false;
            }

            $_fillables = parent::getFillablesOnly($sessionData);
            return parent::store($_fillables);
        }
    }