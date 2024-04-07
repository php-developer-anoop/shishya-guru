<?php
namespace App\Models;
use CodeIgniter\Model;
class Common_model extends Model {
    public $DBGroup = 'default';
    public $table = "dt_setting";
    public $primaryKey = 'id';
    public $useAutoIncrement = true;
    public $allowedFields;
    public function insertRecords($table, $data) {
        $builder = $this->db->table($table);
        $builder->insert($data);
        return $this->db->insertID();
    }
    public function insertBatchItems($table, $data) {
        $builder = $this->db->table($table);
        if (!empty($data)) {
            $builder->insertBatch($data);
        }
    }
    public function updateBatchItems($table, $data) {
        $builder = $this->db->table($table);
        if (!empty($data)) {
            $indexColumn = isset($data[0]) ? array_keys($data[0])[0] : null;
            if ($indexColumn !== null) {
                $builder->updateBatch($data, $indexColumn);
            } else {
                foreach ($data as $row) {
                    $index = array_shift($row); // Extracting the first element as the index
                    $updateData = $row; // Use remaining data as update data
                    unset($updateData[(int)$indexColumn]); // Exclude index column from update data
                    $builder->where($index)->update($table, $updateData);
                }
            }
        }
    }
    public function getAllData($table = null, $select = null, $where = null, $limit = null, $offset = null, $orderby = null, $key = null, $groupby = null, $joinArray=null) {
        $builder = $this->db->table($table);
        if (!empty($select)) {
            $builder->select($select);
        }
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($key)) {
            $builder->orderBy($key, $orderby);
        } else if (empty($key) && !empty($orderby)) {
            $builder->orderBy($this->primaryKey, $orderby);
        }
        if (!empty($limit)) {
            if (!empty($offset)) {
                $builder->limit($limit, $offset);
            } else {
                $builder->limit($limit);
            }
        }
        if (!empty($groupby)) {
            $builder->groupBy($groupby);
        }
        if( !empty($joinArray) ){
            foreach ($joinArray as $key => $value) {
                $builder->join( $value['table'], $value['join_on'], $value['join_type'] );
            } 
        }
        $results = $builder->get()->getResultArray();
        return $results;
    }
    public function countRecords($table = null, $where = null, $selectKey = null,$groupby = null) {
        $builder = $this->db->table($table);
        if (!empty($selectKey)) {
            $builder->select($selectKey);
        }
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($groupby)) {
            $builder->groupBy($groupby);
        }
        $results = $builder->get()->getResultArray();
        return $results;
    }
    public function getSingle($table = null, $select = null, $where = null, $orderby = null,$jointable = null, $join = null) {
        $builder = $this->db->table($table);
        if (!empty($select)) {
            $builder->select($select);
        }
        if (!empty($where)) {
            $builder->where($where);
        }
        if (!empty($orderby)) {
            $builder->orderBy($this->primaryKey, $orderby);
        }
        if (!empty($jointable) && !empty($join)) {
            $builder->join($jointable, $join);
        }
        return $builder->get()->getRowArray();
    }
    public function updateRecords($table, $data, $where) {
        $builder = $this->db->table($table);
        $builder->set($data)->where($where)->update();
        return true;
    }
    public function deleteRecords($table, $where) {
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->delete();
        return true;
    }
    public function getfilter($table, $where = false, $limit = false, $start = false, $orderby = false, $orderbykey = false, $getorcount = false, $select = false) {
        $builder = $this->db->table($table);
        if (!empty($select)) {
            $builder->select($select);
        }
        if (!empty($where)) {
            $builder->where($where);
        }
        $builder->limit($limit, $start);
        $builder->orderBy($orderbykey, $orderby);
        if (!empty($getorcount) && $getorcount == "count") {
            $results = $builder->get()->getResultArray();
            return count($results);
        } else if (!empty($getorcount) && $getorcount == "get") {
            $results = $builder->get()->getResultArray();
            return $results;
        }
    }
    public function updateData($table, $data, $where) {
        $builder = $this->db->table($table);
        $builder->set($data)->where($where);
        if ($builder->update()) {
            return true; // Return true if the update was successful.
            
        } else {
            return false; // Return false if the update failed.
            
        }
    }
    public function saveupdate($table, $data, $validation = null, $where = null, $id = null) {
        $builder = $this->db->table($table);
        if (!is_null($where)) {
            $status = $builder->set($data)->where($where)->update();
            return !is_null($id) ? $id : $status;
        } else {
            if (!is_null($validation)) {
                $builder->where($validation);
            }
            if (!is_null($validation) && $builder->countAllResults() > 0) {
                return false;
            } else {
                $builder->insert($data);
                return $this->db->insertID();
            }
        }
    }
}
?>