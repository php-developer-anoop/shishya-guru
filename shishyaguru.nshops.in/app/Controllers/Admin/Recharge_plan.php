<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Recharge_plan extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_recharge_plans';
    }
    public function index() {
        $data['menu'] = 'Recharge Plan Master';
        $data['title'] = 'Recharge Plan List';
        adminView('plan-list', $data);
    }
    function add_plan() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Recharge Plan Master";
        $data["title"] = !empty($id)?"Edit Recharge Plan":"Add Recharge Plan";
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['amount'] = !empty($savedData['amount']) ? (int)$savedData['amount'] : '';
        $data['cashback_amount'] = !empty($savedData['cashback_amount']) ? (int)$savedData['cashback_amount'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('add-plan', $data);
    }
    public function save_plan() {
        $post = $this->request->getVar();
        $id = !empty($post['id']) ? $post['id'] : '';
        $data = [];
        $response = [];
    
        $data['amount'] = (trim($post['amount']));
        
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
    
        if ($duplicate && ($id === '' || $duplicate['id'] !== $id)) {
            $response['status'] = false;
            $response['message'] = 'Duplicate Entry';
            echo json_encode($response);
            exit;
        }
        
        $data['cashback_amount'] = (trim($post['cashback_amount']));
        $data['status'] = trim($post['status']);
    
        if (empty($id)) {
            $data['add_date']=date('Y-m-d H:i:s');
            $last_id = $this->c_model->insertRecords($this->table, $data);
            $message = 'Data Added Successfully';
        } else {
            $data['update_date']=date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $last_id = $id;
            $message = 'Data Updated Successfully';
        }
    
        $url = base_url(ADMINPATH . 'add-plan') . '?id=' . $last_id;
        $response['status'] = true;
        $response['message'] = $message;
        $response['url'] = $url;
        echo json_encode($response);
        exit;
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
            $where[" amount LIKE '%" . $searchString . "%' OR cashback_amount LIKE '%" . $searchString . "%'"] = null;
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
        $select = '*,DATE_FORMAT(add_date , "%d-%m-%Y %r") AS add_date,DATE_FORMAT(update_date , "%d-%m-%Y %r") AS update_date';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start,$orderby,'id');
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