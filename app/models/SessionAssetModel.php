<?php 

    class SessionAssetModel extends Model
    {
        public $table = 'session_assets';

        public function add($sessionId, $assetId) {

            $exist = parent::single([
                'session_id' => $sessionId,
                'asset_id' => $assetId
            ]);

            if($exist) {
                $this->addError("File Already exists");
                return false;
            } else {
                return parent::store([
                    'session_id' => $sessionId,
                    'asset_id' => $assetId
                ]);
            }
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
                "SELECT att.*, aa.*, sa.*
                    FROM {$this->table} as sa 
                    LEFT JOIN assets as aa 
                        ON sa.asset_id = aa.id 
                    LEFT JOIN attachments as att
                        ON att.global_id = aa.id AND 
                        global_key = 'ASSET_FILE'
                        
                    {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }