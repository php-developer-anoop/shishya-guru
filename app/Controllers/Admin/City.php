<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class City extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_city_list';
    }
    public function index() {
        $data['menu'] = 'City Master';
        $data['title'] = 'City List';
        adminView('city-list', $data);
    }
    function add_city() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "City Master";
        $data["title"] = !empty($id) ? "Edit City" : "Add City";
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['state_id'] = !empty($this->request->getVar('state_id')) ? $this->request->getVar('state_id') : '';
        $data['city_name'] = !empty($savedData['city_name']) ? $savedData['city_name'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        $data['city_list'] = !empty($data['state_id']) ? $this->c_model->getAllData($this->table, 'id,city_name,status,jpg_image,webp_image', ['state_id' => $data['state_id']]) : [];
        adminView('add-city', $data);
    }
    public function save_city() {
        $post = $this->request->getPost();
        if (!empty($post["city_name"])) {
            $city_data = [];
            $count = count($post["city_name"]);
            for ($i = 0;$i < $count;$i++) {
                if (empty($post["city_name"][$i])) {
                    continue;
                }
                $status_key = "status" . ($i + 1);
                $arr = ["state_id" => trim($post['state_id']), "city_name" => trim($post["city_name"][$i]), "status" => isset($post[$status_key][0]) ? $post[$status_key][0] : null, "add_date" => date('Y-m-d H:i:s') ];
                array_push($city_data, $arr);
            }
            if (!empty($city_data)) {
                $existing_records = $this->c_model->getAllData($this->table, 'id,city_name', ['state_id' => $post['state_id']]);
                if ($existing_records) {
                    foreach ($city_data as $city) {
                        $existing = false;
                        foreach ($existing_records as $existing_record) {
                            if (($city['city_name'] === $existing_record['city_name'])) {
                                $existing = true;
                                //$this->c_model->updateRecords($this->table, $city, ['id' => $existing_record['id']]);
                                break;
                            }
                        }
                        if (!$existing) {
                            $this->c_model->insertRecords($this->table, $city);
                        }
                    }
                    $this->session->setFlashData('success', 'Data Added Successfully');
                } else {
                    $this->c_model->insertBatchItems($this->table, $city_data);
                    $this->session->setFlashData('success', 'Data Added Successfully');
                }
            } else {
                $this->session->setFlashData('error', 'No data to add');
            }
        }
        return redirect()->to(base_url(ADMINPATH . 'add-city?state_id=' . $post['state_id']));
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
            $where[" city_name LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_city_list as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $img_url = base_url('uploads/');
        $select = 'a.*,CONCAT("' . $img_url . '", a.jpg_image) as img_url, DATE_FORMAT(a.add_date, "%d-%m-%Y %r") AS add_date, b.state_name';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id', null, $joinArray);
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
    function save_city_image() {
        $post = $this->request->getPost();
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file(ROOTPATH . 'uploads/' . $post['old_image_jpg']) && file_exists(ROOTPATH . 'uploads/' . $post['old_image_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_image_jpg']);
                }
                if (is_file(ROOTPATH . 'uploads/' . $post['old_image_webp']) && file_exists(ROOTPATH . 'uploads/' . $post['old_image_webp'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_image_webp']);
                }
                $file->move(ROOTPATH . '/uploads/', $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $webp_image = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['jpg_image'] = $filename;
                $data['webp_image'] = $webp_image;
                $this->c_model->updateRecords($this->table, $data, ['id' => $post['city_id']]);
            }
        }
    }
    public function add_city_faq() {
        $id = !empty($this->request->getVar('city_id')) ? $this->request->getVar('city_id') : '';
        $data = [];
        $data["menu"] = "City FAQ";
        $data["title"] = !empty($id) ? "Edit City FAQ" : "Add City FAQ";
        $data['faqs'] = $this->c_model->getAllData('faq_master', '*', ['table_id' => $id, 'table_name' => $this->table]);
        $data['city_id'] = $id;
        adminView('add-city-faq', $data);
    }
    public function save_city_faq() {
        $post = $this->request->getPost();
        $city_id = !empty($post['id']) ? $post['id'] : '';
        $faq_data = [];
        $count = count($post["faq_question"]);
        for ($i = 0;$i < $count;$i++) {
            if ($post["faq_question"][$i] == "" || $post["faq_answer"][$i] == "") {
                continue;
            }
            $arr = ["table_name" => $this->table, "table_id" => $city_id, "question" => $post["faq_question"][$i], "answer" => $post["faq_answer"][$i], "add_date" => date('Y-m-d H:i:s') ];
            $faq_data[] = $arr;
            
        }
        if (count($faq_data) > 0) {
            $del = $this->c_model->deleteRecords("faq_master", ["table_name" => $this->table, "table_id" => $city_id]);
            if ($del) {
                $this->c_model->insertBatchItems("faq_master", $faq_data);
            }
        }
        return redirect()->to(base_url(ADMINPATH . 'city-list'));
    }
}
?>