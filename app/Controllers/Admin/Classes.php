<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Classes extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_class_list';
    }
    public function index() {
        $data['menu'] = 'Class Master';
        $data['title'] = 'Class List';
        adminView('class-list', $data);
    }
    function add_class() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Class Master";
        $data["title"] = !empty($id) ? "Edit Class" : "Add Class";
        $data['boards_list']=$this->c_model->getAllData('boards_list','id,board_name',['status'=>'Active']);
        $data['class_group_list']=$this->c_model->getAllData('class_group_list','id,class_group_name',['status'=>'Active']);
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['class_name'] = !empty($savedData['class_name']) ? $savedData['class_name'] : '';
        $data['class_group_id'] = !empty($savedData['class_group_id']) ? $savedData['class_group_id'] : '';
        $data['boards'] = !empty($savedData['boards']) ? explode(',', $savedData['boards']) : [];
      
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('add-class', $data);
    }
    public function save_class() {
        $post = $this->request->getVar();
        
        $id = !empty($post['id']) ? $post['id'] : '';
        $data = [];
        $response = [];
        $data['class_group_id'] = trim($post['class_group_id']); 
        $data['class_name'] = trim($post['class_name']); 
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
        if ($duplicate && ($id === '' || $duplicate['id'] !== $id)) {
            $response['status'] = false;
            $response['message'] = 'Duplicate Entry';
            echo json_encode($response);
            exit;
        }
        $data['boards'] = !empty($post['boards'])?implode(',',$post['boards']):[];
        $data['status'] = trim($post['status']);
        if (empty($id)) {
            $data['add_date'] = date('Y-m-d H:i:s');
            $last_id = $this->c_model->insertRecords($this->table, $data);
            $message = 'Data Added Successfully';
        } else {
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $last_id = $id;
            $message = 'Data Updated Successfully';
        }
        $url = base_url(ADMINPATH . 'add-class') . '?id=' . $last_id;
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
            $where["dt_class_list.class_name LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_class_list as a';
        $joinArray[0]['table'] = 'dt_class_group_list as b';
        $joinArray[0]['join_on'] = 'a.class_group_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $select = 'a.*,DATE_FORMAT(a.add_date , "%d-%m-%Y %r") AS add_date,DATE_FORMAT(a.update_date , "%d-%m-%Y %r") AS update_date,b.class_group_name';
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