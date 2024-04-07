<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Wallet extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_wallet';
    }
    public function index() {
        $data['menu'] = 'Wallet';
        $data['title'] = 'Wallet History';
        $data['from_date']=!empty($this->request->getGet('from_date'))?$this->request->getGet('from_date'):'';
        $data['to_date']=!empty($this->request->getGet('to_date'))?$this->request->getGet('to_date'):'';
        adminView('wallet', $data);
    }
    public function getRecords() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)(!empty($get["start"]) ? $get["start"] : 0);
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        
        if (!empty($get['user_id'])) {
            $where['user_id'] = $get['user_id'];
        }
        if (!empty($get['from_date']) && !empty($get['to_date'])) {
            $where['DATE(created_date) >='] = $get['from_date'];
            $where['DATE(created_date) <='] = $get['to_date'];
        }

        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where["credit_debit LIKE '%" . $searchString . "%' OR before_amount LIKE '%" . $searchString . "%' OR txn_amount LIKE '%" . $searchString . "%' OR final_amount LIKE '%" . $searchString . "%' OR transaction_id LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_wallet as a';
        $joinArray[0]['table'] = 'dt_tutor_list as b';
        $joinArray[0]['join_on'] = 'a.user_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $select = 'a.*, DATE_FORMAT(a.created_date, "%d-%m-%Y %r") AS created_date, b.tutor_name';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'a.id', null, $joinArray);
        $result = [];
        if (!empty($listData)) {
            $i = $start + 1;
            foreach ($listData as $key => $value) {
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