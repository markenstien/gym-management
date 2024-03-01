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
                    att.filename,att.file_type,
                    att.display_name,
                    att.global_key, att.global_id,
                    att.id as attachment_id,
                    att.path, att.url,
                    att.full_path as att_full_path,
                    att.full_url as att_full_url, att.description as att_description ,
                    
                    atticon_.full_path as atticon_full_path,
                    atticon_.full_url as atticon_full_url, atticon_.description as atticon_icondescription

                    FROM {$this->table} as asset
                    LEFT JOIN attachments as att 
                        ON att.global_id = asset.id
                        AND att.global_key = 'ASSET_FILE'

                    LEFT JOIN attachments as atticon_
                        ON atticon_.global_id = asset.id
                        AND atticon_.global_key = 'ASSET_FILE_ICON'
                        
                {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }
    }