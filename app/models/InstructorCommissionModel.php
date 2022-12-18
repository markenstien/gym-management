<?php 

    class InstructorCommissionModel extends Model
    {
        public $table = 'instructor_commissions';

        public $_fillables = [
            'instructor_id',
            'user_program_id',
            'amount',
            'entry_type',
            'remarks'
        ];

        public function createOrUpdate($data, $id = null) {
            $_fillables = parent::getFillablesOnly($data);
            
            if(!is_null($id)) {
                $retVal = parent::update($_fillables, $id);
                $this->addMessage("Commission Updated");
            } else {
                $retVal = parent::store($_fillables);
                $this->addMessage("Commission Created");
            }

            return $retVal;
        }
    }