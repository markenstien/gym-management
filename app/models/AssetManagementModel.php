<?php 

    class AssetManagementModel extends Model
    {
        public $table = 'assets';

        public function get($id) {
            return $this->getAll([
                'where' => $id
            ])[0] ?? false;
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
                $limit = " LIMIT {$params['order']}";
            }

            $this->db->query(
                "SELECT asset.*,
                    filename,file_type,
                    display_name,
                    global_key, global_id,
                    att.id as attachment_id,
                    path, url,
                    full_path,
                    full_url, att.description as attachment_description 
                    
                    FROM {$this->table} as asset
                    LEFT JOIN attachments as att 
                        ON att.global_id = asset.id
                        AND att.global_key = 'ASSET_FILE'
                        
                {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }