<?php 

    class SessionRemarkModel extends Model
    {
        public $table = 'session_remarks';

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
                $limit = " LIMIT {$params['order']}";
            }

            $this->db->query(
                "SELECT sr.remarks as remarks,
                    concat(member.firstname, ' ',member.lastname) as member_fullname,
                    concat(instructor.firstname, ' ',instructor.lastname) as instructor_fullname,
                    ip.*, sr.*, sr.id as id
                        FROM {$this->table} as sr

                    LEFT JOIN users as member 
                        ON member.id = sr.member_id
                    LEFT JOIN users as instructor
                        ON instructor.id = sr.instructor_id
                    LEFT JOIN `sessions` as session 
                        ON session.id = sr.session_id
                    LEFT JOIN instructor_packages as ip
                        ON ip.id = session.package_id
                        
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }