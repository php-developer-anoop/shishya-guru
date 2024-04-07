<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Leads extends BaseController {
    public $c_model;
    protected $session;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
    }
    public function index() {
        $type = !empty($this->request->getGet('type')) ? $this->request->getGet('type') : '';
        $data['meta_title'] = $type . ' Leads - Tutor Panel';
        $data['meta_description'] = $type . ' Leads - Tutor Panel';
        $data['meta_keyword'] = $type . ' Leads - Tutor Panel';
        $data['page_name'] = $type . ' Leads';
        tutorView('new-leads', $data);
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
        $user = tutorProfile();
        if (!empty($get['type'])) {
            $where['lead_status'] = $get['type'];
        }
        $where['city_id'] = $user['city'];
        //$where['FIND_IN_SET('.$user['id'].',accepted_by) >'] = 0;
        $where['subject_id IN (' . $user['subject'] . ')'] = null;
        $where['class_id IN (' . $user['class'] . ')'] = null;
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where["name LIKE '%" . $searchString . "%' OR email LIKE '%" . $searchString . "%' OR subject_name LIKE '%" . $searchString . "%' OR class_name LIKE '%" . $searchString . "%' OR board_name LIKE '%" . $searchString . "%' OR tuition_mode LIKE '%" . $searchString . "%' OR city_name LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords('leads_list', $where, 'id');
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? sizeof($countData) : 0);
            exit();
        }
        if (!empty($get["showRecords"])) {
            $limit = $get["showRecords"];
            $orderby = "DESC";
        }
        $select = '*,DATE_FORMAT(add_date , "%d/%m/%Y %r") AS add_date';
        $listData = $this->c_model->getAllData('leads_list', $select, $where, $limit, $start, $orderby);
        //echo $this->c_model->getLastQuery();exit;
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
    public function showNumber() {
        $response = [];
        $post = $this->request->getPost();
        $lead_id = !empty($post['lead_id']) ? trim($post['lead_id']) : '';
        $class_id = !empty($post['class_id']) ? trim($post['class_id']) : '';
        $city_id = !empty($post['city_id']) ? trim($post['city_id']) : '';
        $mobile_no = getSingle('leads_list', 'mobile_no,lead_count,accepted_by', ['id' => $lead_id]);
        $class_group_id = getClassGroupIdFromClassId($class_id);
        $lead = $this->c_model->getSingle('leads_master', 'cost_per_lead', ['city_id' => $city_id, 'class_group_id' => $class_group_id]);
        $tutor = tutorProfile();
        if (!empty($mobile_no['accepted_by'])) {
            $new_accepted_by = $mobile_no['accepted_by'] . ',' . $tutor['id'];
        } else {
            $new_accepted_by = $tutor['id'];
        }
        if ($lead && $tutor && $lead['cost_per_lead'] >= $tutor['wallet_balance']) {
            $response['status'] = false;
            $response['message'] = 'Insufficient balance';
            echo json_encode($response);
            exit;
        } else if ($lead && $tutor && $lead['cost_per_lead'] <= $tutor['wallet_balance']) {
            $data = [];
            $data['wallet_balance'] = $tutor['wallet_balance'] - $lead['cost_per_lead'];
            $saveData = [];
            $saveData['tutor_id'] = $tutor['id'];
            $saveData['lead_table_id'] = $lead_id;
            $saveData['accepted_amount'] = $lead['cost_per_lead'];
            $saveData['status'] = 'Accepted';
            $saveData['add_date'] = date('Y-m-d H:i:s');
            if ($mobile_no['lead_count'] >= LEADS_COUNT) {
                $response['status'] = false;
                $response['message'] = 'Lead Accepting Count exceeds the limit';
                echo json_encode($response);
                exit;
            } else {
                $txn_id = 'SG_' . rand(000000000, 999999999);
                $saveWallet = ['credit_debit' => 'debit', 'lead_id' => $lead_id, 'user_id' => $tutor['id'], 'before_amount' => $tutor['wallet_balance'], 'transaction_id' => $txn_id, 'txn_amount' => $lead['cost_per_lead'], 'final_amount' => $tutor['wallet_balance'] - $lead['cost_per_lead'], 'created_date' => date('Y-m-d H:i:s'), 'remark' => 'Deducted Amount For Accepting Lead Id = ' . $lead_id];
                $this->c_model->insertRecords('wallet', $saveWallet);
                $this->c_model->insertRecords('accepted_leads', $saveData);
                $this->c_model->updateRecords('tutor_list', $data, ['id' => $tutor['id']]);
                $this->c_model->updateRecords('leads_list', ['lead_status' => 'Accepted', 'lead_count' => ($mobile_no['lead_count'] + 1), 'accepted_by' => $new_accepted_by], ['id' => $lead_id]);
                $response['status'] = true;
                $response['mobile_no'] = $mobile_no['mobile_no'];
                echo json_encode($response);
                exit;
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'Invalid lead or tutor';
            echo json_encode($response);
            exit;
        }
    }
    public function picked_leads() {
        $data['meta_title'] = 'Picked Leads - Tutor Panel';
        $data['meta_description'] = 'Picked Leads - Tutor Panel';
        $data['meta_keyword'] = 'Picked Leads - Tutor Panel';
        $data['page_name'] = 'Picked Leads';
        tutorView('picked-enquiry', $data);
    }
    public function getPickedRecords() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)!empty($get["start"]) ? $get["start"] : 0;
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        $where['lead_count <='] = 10;
        $user = tutorProfile();
        $where['lead_status'] = 'Accepted';
        $where['city_id'] = $user['city'];
        $where['subject_id IN (' . $user['subject'] . ')'] = null;
        $where['FIND_IN_SET(' . $user['id'] . ', accepted_by) >'] = 0;
        $where['class_id IN (' . $user['class'] . ')'] = null;
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where["name LIKE '%" . $searchString . "%' OR email LIKE '%" . $searchString . "%' OR subject_name LIKE '%" . $searchString . "%' OR class_name LIKE '%" . $searchString . "%' OR board_name LIKE '%" . $searchString . "%' OR tuition_mode LIKE '%" . $searchString . "%' OR city_name LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords('leads_list', $where, 'id');
        //echo $this->c_model->getLastQuery();exit;
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? sizeof($countData) : 0);
            exit();
        }
        if (!empty($get["showRecords"])) {
            $limit = $get["showRecords"];
            $orderby = "DESC";
        }
        $select = '*,DATE_FORMAT(add_date , "%d/%m/%Y %r") AS add_date';
        $listData = $this->c_model->getAllData('leads_list', $select, $where, $limit, $start, $orderby);
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
    public function active_tuitions() {
        $data['meta_title'] = 'Active Tuitions - Tutor Panel';
        $data['meta_description'] = 'Active Tuitions - Tutor Panel';
        $data['meta_keyword'] = 'Active Tuitions - Tutor Panel';
        $data['page_name'] = 'Active Tuitions';
        $data['schedule_list'] = $this->c_model->getAllData('schedule_master', 'id,name', ['status' => 'Active'], null, null, 'DESC');
        tutorView('active-tuition', $data);
    }
    public function getActiveTuitions() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)!empty($get["start"]) ? $get["start"] : 0;
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        $user = tutorProfile();
        $where['lead_status'] = 'Assigned';
        $where['assigned_tutor_id'] = $user['id'];
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where["name LIKE '%" . $searchString . "%' OR email LIKE '%" . $searchString . "%' OR subject_name LIKE '%" . $searchString . "%' OR class_name LIKE '%" . $searchString . "%' OR board_name LIKE '%" . $searchString . "%' OR tuition_mode LIKE '%" . $searchString . "%' OR city_name LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords('leads_list', $where, 'id');
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? sizeof($countData) : 0);
            exit();
        }
        if (!empty($get["showRecords"])) {
            $limit = $get["showRecords"];
            $orderby = "DESC";
        }
        $select = '*,DATE_FORMAT(add_date , "%d/%m/%Y %r") AS add_date';
        $listData = $this->c_model->getAllData('leads_list', $select, $where, $limit, $start, $orderby);
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
    public function save_schedule() {
        $post = $this->request->getPost();
        $saveData = [];
        $response = [];
        $date = !empty($post['date']) ? date('Y-m-d', strtotime($post['date'])) : '';
        $time = !empty($post['time']) ? date('H:i:s', strtotime($post['time'])) : '';
        $saveData['schedule_name'] = !empty($post['schedule_name']) ? trim($post['schedule_name']) : '';
        $saveData['description'] = !empty($post['description']) ? trim($post['description']) : '';
        $saveData['lead_id'] = !empty($post['lead_id']) ? trim($post['lead_id']) : '';
        $saveData['student_name'] = !empty($post['student_name']) ? trim($post['student_name']) : '';
        $saveData['student_mobile_no'] = !empty($post['student_mobile_no']) ? trim($post['student_mobile_no']) : '';
        $saveData['student_email'] = !empty($post['student_email']) ? trim($post['student_email']) : '';
        $saveData['schedule_date_time'] = $date . ' ' . $time;
        $saveData['add_date'] = date('Y-m-d H:i:s');
        $schedule_id = $this->c_model->insertRecords('schedule_list', $saveData);
        if ($schedule_id) {
            $response['status'] = true;
            $response['message'] = "Schedule Added Successfully";
            echo json_encode($response);
            exit;
        } else {
            $response['status'] = false;
            $response['message'] = "Something Went Wrong";
            echo json_encode($response);
            exit;
        }
    }
}
