<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Lead extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_leads_master';
    }
    public function index() {
        $data['menu'] = 'Lead Master';
        $data['title'] = 'Lead List';
        adminView('lead-list', $data);
    }
    function add_lead() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Lead Master";
        $data["title"] = !empty($id)?"Edit Lead":"Add Lead";
        $data['state_list'] = $this->c_model->getAllData('state_list', 'id,state_name', ['status' => 'Active']);
        $data['class_group_list'] = $this->c_model->getAllData('class_group_list', 'id,class_group_name', ['status' => 'Active']);
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['state_id'] = !empty($savedData['state_id']) ? $savedData['state_id'] : '';
        $data['city_id'] = !empty($savedData['city_id']) ? $savedData['city_id'] : '';
        $data['class_group_id'] = !empty($savedData['class_group_id']) ? $savedData['class_group_id'] : '';
        $data['cost_per_lead'] = !empty($savedData['cost_per_lead']) ? $savedData['cost_per_lead'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('add-lead', $data);
    }
    public function save_lead() {
        $post = $this->request->getVar();
        $id = !empty($post['id']) ? $post['id'] : '';
        $data = [];
        $response = [];
    
        $data['state_id'] = trim($post['state_id']);
        $data['city_id'] = trim($post['city_id']);
        $data['class_group_id'] = trim($post['class_group_id']);
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
    
        if ($duplicate && ($id === '' || $duplicate['id'] !== $id)) {
            $response['status'] = false;
            $response['message'] = 'Duplicate Entry';
            echo json_encode($response);
            exit;
        }
        $data['cost_per_lead'] = trim($post['cost_per_lead']);
    
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
    
        $url = base_url(ADMINPATH . 'add-lead') . '?id=' . $last_id;
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
            $where[" cost_per_lead LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_leads_master as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';

        $joinArray[1]['table'] = 'dt_class_group_list as c';
        $joinArray[1]['join_on'] = 'a.class_group_id = c.id';
        $joinArray[1]['join_type'] = 'INNER';
        
        $joinArray[2]['table'] = 'dt_city_list as d';
        $joinArray[2]['join_on'] = 'a.city_id = d.id';
        $joinArray[2]['join_type'] = 'INNER';
        $select = 'a.*,DATE_FORMAT(a.add_date , "%d-%m-%Y %r") AS add_date,DATE_FORMAT(a.update_date , "%d-%m-%Y %r") AS update_date,b.state_name,c.class_group_name,d.city_name';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start,$orderby,'id',null,$joinArray);
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