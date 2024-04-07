<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Faq extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_faq_master';
    }
    public function index() {
        $data['menu'] = 'FAQ Master';
        $data['title'] = 'FAQ List';
        adminView('faq-list', $data);
    }
    function add_faq() {
        $table_id = !empty($this->request->getVar('table_id')) ? $this->request->getVar('table_id') : '';
        $table_name = !empty($this->request->getVar('table_name')) ? $this->request->getVar('table_name') : '';
        $data = [];
        $data["menu"] = "FAQ Master";
        $data["title"] = !empty($id) ? "Edit FAQ" : "Add FAQ";
        $data['table_id'] = $table_id;
        $data['table_name'] = $table_name;
        $data['faqs'] = $this->c_model->getAllData($this->table, 'id,question,answer', ['table_id' => $table_id, 'table_name' => $table_name]);
        adminView('add-faq', $data);
    }
    public function save_faq() {
        $post = $this->request->getVar();
        $table_id = !empty($post['table_id']) ? $post['table_id'] : '';
        $table_name = !empty($post['table_name']) ? $post['table_name'] : '';
        $faq_data = [];
        $count = count($post["faq_question"]);
        for ($i = 0;$i < $count;$i++) {
            if ($post["faq_question"][$i] == "" || $post["faq_answer"][$i] == "") {
                continue;
            }
            $arr = ["table_name" => $table_name, "table_id" => $table_id, "question" => $post["faq_question"][$i], "answer" => $post["faq_answer"][$i], "add_date" => date('Y-m-d H:i:s') ];
            array_push($faq_data, $arr);
        }
        if (count($faq_data) > 0) {
            $del = $this->c_model->deleteRecords("faq_master", ['table_id' => $table_id, "table_name" => $table_name]);
            if ($del == true) {
                // $data['faq_schema'] = generateFaqSchema($faq_data);
                // $this->c_model->updateRecords($this->table, $data, ['id' => $table_id]);
                $this->session->setFlashData('success', 'Data Added Successfully');
                $this->c_model->insertBatchItems("faq_master", $faq_data);
            }
        }
        return redirect()->to(base_url(ADMINPATH . 'faq-list'));
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
            $where[" question LIKE '%" . $searchString . "%' OR answer LIKE '%" . $searchString . "%'"] = null;
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
        $select = '*,DATE_FORMAT(add_date , "%d-%m-%Y %r") AS add_date';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id');
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