<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Leads_list extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_leads_list';
    }
    public function index() {
        $data['menu'] = 'Leads List';
        $type = !empty($this->request->getGet('type')) ? $this->request->getGet('type') : '';
        $data['title'] = $type . ' Leads';
        adminView('leads', $data);
    }
    public function getRecords() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $user_id = !empty($get['user_id']) ? $get['user_id'] : '';
        $type = !empty($get['type']) ? $get['type'] : '';
        $limit = isset($get["length"]) ? (int)$get["length"] : 1;
        $start = isset($get["start"]) ? (int)$get["start"] : 0;
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = isset($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        if (!empty($user_id)) {
            $where['lead_status'] = 'Assigned';
            $where['assigned_tutor_id'] = $user_id;
        }else{
            if (!empty($type) && $type != "All") {
            $where['lead_status'] = $type;
        }
        if (!empty($type) && $type == "Pending") {
            $where['lead_status'] = 'Accepted';
        }
        }
        
        
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where["name LIKE '%" . $searchString . "%' OR email LIKE '%" . $searchString . "%' OR subject_name LIKE '%" . $searchString . "%' OR class_name LIKE '%" . $searchString . "%' OR board_name LIKE '%" . $searchString . "%' OR tuition_mode LIKE '%" . $searchString . "%' OR city_name LIKE '%" . $searchString . "%' OR assigned_tutor_name LIKE '%" . $searchString . "%' OR assigned_tutor_mobile_no LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords($this->table, $where, 'id');
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? sizeof($countData) : 0);
            exit();
        }
        if (isset($get["showRecords"])) {
            $limit = $get["showRecords"];
        }
        $select = '*, DATE_FORMAT(add_date , "%d-%m-%Y %r") AS add_date,DATE_FORMAT(assigned_date_time , "%d-%m-%Y %r") AS assigned_date_time';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id');
        $result = [];
        if (!empty($listData)) {
            $i = $start + 1;
            foreach ($listData as $key => $value) {
                $push = $value;
                $push["sr_no"] = $i;
                $result[] = $push;
                $i++;
            }
        }
        $json_data = ["draw" => intval($get["draw"]), "recordsTotal" => intval($totalRecords), "recordsFiltered" => intval($totalRecords), "data" => $result];
        if (!empty($searchString)) {
            $json_data["recordsTotal"] = $json_data["recordsFiltered"] = count($result);
        }
        echo json_encode($json_data);
    }
}
?>