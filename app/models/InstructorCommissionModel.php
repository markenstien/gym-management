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

        public function getAll($params = []) {
            $where = null;
            $order = null;
            $limit = null;

            if(!empty($params['where'])) {
                $where = " WHERE ".parent::conditionConvert($params['where']);
            }

            if(!empty($params['order'])) {
                $order = " ORDER BY {$params['order']} ";
            }

            if(!empty($params['limit'])) {
                $limit = " LIMIT {$params['limit']} ";
            }
            $this->db->query(
                "SELECT {$this->table}.*, concat(user.firstname, ' ' ,user.lastname) instructor_name FROM {$this->table} 
                    LEFT JOIN users as user 
                    ON user.id = {$this->table}.instructor_id
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }