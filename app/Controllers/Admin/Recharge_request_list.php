<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Recharge_request_list extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_recharge_request';
    }
    public function index() {
        $data['menu'] = 'Recharge Request List';
        $data['title'] = 'Recharge Request List';
        adminView('recharge-request-list', $data);
    }

    public function getRecords() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $type= !empty($get['type'])?$get['type']:'';
        $user_id= !empty($get['user_id'])?$get['user_id']:'';
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)!empty($get["start"]) ? $get["start"] : 0;
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        if(!empty($type)){
            $where['status']=$type;
        }
        if(!empty($user_id)){
            $where['tutor_id']=$user_id;
        }
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where["tutor_name LIKE '%" . $searchString . "%' OR tutor_unique_id LIKE '%" . $searchString . "%' OR amount LIKE '%" . $searchString . "%' OR txn_id LIKE '%" . $searchString . "%' OR status LIKE '%" . $searchString . "%'"] = null;
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