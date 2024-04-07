<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Wallet extends BaseController {
    public $c_model;
    protected $session;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
    }
    public function index() {
        $data['meta_title'] = 'My Wallet - Tutor Panel';
        $data['meta_description'] = 'My Wallet - Tutor Panel';
        $data['meta_keyword'] = 'My Wallet - Tutor Panel';
        $data['company'] = webSetting('qr_code,upi_id');
        $data['plan_list'] = $this->c_model->getAllData('recharge_plans', 'amount', ['status' => 'Active']);
        tutorView('wallet', $data);
    }
    public function my_wallet_records() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)!empty($get["start"]) ? $get["start"] : 0;
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        $user = getTutorProfile();
        $where['user_id'] = $user['id'];
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where[" credit_debit LIKE '%" . $searchString . "%' OR txn_amount LIKE '%" . $searchString . "%' OR transaction_id LIKE '%" . $searchString . "%' OR status LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords('wallet', $where, 'id');
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? sizeof($countData) : 0);
            exit();
        }
        if (!empty($get["showRecords"])) {
            $limit = $get["showRecords"];
            $orderby = "DESC";
        }
        $select = '*,DATE_FORMAT(created_date , "%d/%m/%Y %r") AS add_date';
        $listData = $this->c_model->getAllData('wallet', $select, $where, $limit, $start, $orderby);
        // echo $this->c_model->getLastQuery();exit;
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
    public function add_request() {
        $response = [];
        $post = $this->request->getPost();
        $amount = !empty($post['amount']) ? $post['amount'] : '';
        $txn_id = !empty($post['txn_id']) ? $post['txn_id'] : '';
        $tutor_id = !empty($post['tutor_id']) ? $post['tutor_id'] : '';
        $unique_id = !empty($post['unique_id']) ? $post['unique_id'] : '';
        $tutor_name = !empty($post['tutor_name']) ? $post['tutor_name'] : '';
        if (empty($amount)) {
            $response['status'] = false;
            $response['message'] = "Enter Amount";
            echo json_encode($response);
            exit;
        }
        if (empty($txn_id)) {
            $response['status'] = false;
            $response['message'] = "Enter Transaction Id";
            echo json_encode($response);
            exit;
        }
        $check = $this->c_model->getSingle('recharge_request', 'status', ['txn_id' => $txn_id]);
        if (!empty($check)) {
            $response['status'] = false;
            $response['message'] = "Your Request Is " . $check['status'];
            echo json_encode($response);
            exit;
        }
        $saveData = [];
        $saveData['tutor_id'] = trim($tutor_id);
        $saveData['tutor_unique_id'] = trim($unique_id);
        $saveData['tutor_name'] = trim($tutor_name);
        $saveData['amount'] = trim($amount);
        $saveData['txn_id'] = trim($txn_id);
        $saveData['add_date'] = date('Y-m-d H:i:s');
        $request_id = $this->c_model->insertRecords('recharge_request', $saveData);
        if ($request_id) {
            $response['status'] = true;
            $response['message'] = "Request Added Successfully";
            echo json_encode($response);
            exit;
        }
    }
}
