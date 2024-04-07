<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Tuition_fee extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_tuition_fee_list';
    }
    public function index() {
        $data['menu'] = 'Tuition Fee Master';
        $data['title'] = 'Tuition Fee List';
        adminView('tuition-fee-list', $data);
    }
    function add_tuition_fee() {
        $state_id = !empty($this->request->getVar('state_id')) ? $this->request->getVar('state_id') : '';
        $class_id = !empty($this->request->getVar('class_id')) ? $this->request->getVar('class_id') : '';
        $data = [];
        $data["menu"] = "Tuition Fee Master";
        $data["title"] = !empty($state_id) ? "Edit Tuition Fee" : "Add Tuition Fee";
        $data['state_list'] = $this->c_model->getAllData('state_list', 'id,state_name,status', ['status'=>'Active']);
        $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name,status', ['status'=>'Active']);
        $data['fee_list'] = $this->c_model->getAllData($this->table, '*', ['state_id' => $state_id,'class_id' => $class_id,'status'=>'Active']);
        $data['state_id'] = $state_id;
        $data['class_id'] = $class_id;

        adminView('add-tuition-fee', $data);
    }
    public function save_tuition_fee() {
        $post = $this->request->getVar();
        $fee_data = [];
    
        $count = count($post["fee_head"]);
        for ($i = 0; $i < $count; $i++) {
            if ($post["fee_head"][$i] == "" || $post["fee"][$i] == "" || $post["duration"][$i] == "") {
                continue;
            }
    
            $arr = [
                "state_id" => $post['state_id'],
                "class_id" => $post['class_id'],
                "fee_head" => $post["fee_head"][$i],
                "fee"      => $post["fee"][$i],
                "duration" => $post["duration"][$i],
                "add_date" => date('Y-m-d H:i:s')
            ];
            array_push($fee_data, $arr);
        }
    
        if (!empty($fee_data)) {
            // Retrieve existing records
            $existing_records = $this->c_model->getAllData($this->table,'fee_head,id' ,['state_id' => $post['state_id'],'class_id' => $post['class_id']]);
            
            // Check if existing records exist
            if (!empty($existing_records)) {
                foreach ($existing_records as $existing_record) {
                    foreach ($fee_data as $key => $data) {
                        // If fee head already exists, update the record
                        if ($existing_record['fee_head'] == $data['fee_head']) {
                            unset($fee_data[$key]);
                            $this->c_model->updateRecords($this->table, $data, ['id' => $existing_record['id']]);
                        }
                    }
                }
            }
            
            // Insert new records
            if (!empty($fee_data)) {
                $this->c_model->insertBatchItems($this->table, $fee_data);
            }
        }
    
        return redirect()->to(base_url(ADMINPATH . 'tuition-fee-list'));
    }
    
    
    public function getRecords() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)!empty($get["start"]) ? $get["start"] : 0;
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where[" dt_city_list.city_name LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords($this->table, $where, 'id');
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? sizeof($countData) : 0);
            exit();
        }
        if (!empty($get["showRecords"])) {
            $limit = $get["showRecords"];
            $orderby = "DESC";
        }
        $this->table = 'dt_tuition_fee_list as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';

        $joinArray[1]['table'] = 'dt_class_list as c';
        $joinArray[1]['join_on'] = 'a.class_id = c.id';
        $joinArray[1]['join_type'] = 'INNER';
        $select = 'a.*,DATE_FORMAT(a.add_date , "%d-%m-%Y %r") AS add_date,b.state_name,c.class_name';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby,'id', null, $joinArray);
        $result = [];
        if (!empty($listData)) {
            $i = $start + 1;
            foreach ($listData as $key => $value) {
                $push = [];
                $push = $value;
                $push["sr_no"] = $i;
                array_push($result, $push);
                $i++;
            }
        }
        $json_data = [];
        if (!empty($get["search"]["value"])) {
            $countItems = !empty($result) ? count($result) : 0;
            $json_data["draw"] = intval($get["draw"]);
            $json_data["recordsTotal"] = intval($countItems);
            $json_data["recordsFiltered"] = intval($countItems);
            $json_data["data"] = !empty($result) ? $result : [];
        } else {
            $json_data["draw"] = intval($get["draw"]);
            $json_data["recordsTotal"] = intval($totalRecords);
            $json_data["recordsFiltered"] = intval($totalRecords);
            $json_data["data"] = !empty($result) ? $result : [];
        }
        echo json_encode($json_data);
    }
}
?>