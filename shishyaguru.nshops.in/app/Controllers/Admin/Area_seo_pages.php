<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Area_seo_pages extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_area_seo_master';
    }
    public function index() {
        $data['menu'] = 'Area Seo Page Master';
        $data['title'] = 'Area Seo Page List';
        adminView('area-seo-page-list', $data);
    }
    public function add_area_seo_page() {
        $id = $this->request->getVar('id') ??'';
        $seo_page_id = $this->request->getVar('seo_page_id') ??'';
        $data = ["menu" => "Area Seo Page Master", "title" => !empty($id) ? "Edit Area Seo Page" : "Add Area Seo Page"];
        $table_name = !empty($seo_page_id) ? 'dt_seo_master' : $this->table;
        $data_id = !empty($seo_page_id) ? $seo_page_id : $id;
        $savedData = $this->c_model->getSingle($table_name, '*', ['id' => $data_id]);
        $state_city = getCityId($seo_page_id);
        $state_id = !empty($state_city['state_id']) ? $state_city['state_id'] : $savedData['state_id'];
        $city_id = !empty($state_city['city_id']) ? $state_city['city_id'] : $savedData['city_id'];
        $data['area_list'] = !empty($state_id && $city_id) ? $this->c_model->getAllData('area_list', 'id,area_name', ['status' => 'Active', 'state_id' => $state_id, 'city_id' => $city_id]) : [];
        $data['faqs'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['status' => 'Active', 'table_id' => $data_id, 'table_name' => $table_name]);
        $data['id'] = $id;
        $data['seo_page_id'] = $seo_page_id;
        $data['page_name'] = $savedData['page_name']??'';
        $data['slug'] = $savedData['slug']??'';
        $data['meta_title'] = $savedData['meta_title']??'';
        $data['meta_description'] = $savedData['meta_description']??'';
        $data['meta_keyword'] = $savedData['meta_keyword']??'';
        $data['meta_schema'] = !empty($id) && !empty($savedData['meta_schema']) ? $savedData['meta_schema'] : '';
        $data['faq_schema'] = $savedData['faq_schema']??'';
        $data['h1'] = $savedData['h1']??'';
        $data['area_id'] = $savedData['area_id']??'';
        $data['city_id'] = $state_city['city_id']??'';
        $data['state_id'] = $state_city['state_id']??'';
        $data['faq_heading'] = $savedData['faq_heading']??'';
        $data['description'] = $savedData['description']??'';
        $data['banner_image_jpg'] = !empty($id) && !empty($savedData['banner_image_jpg']) ? '' : $savedData['banner_image_jpg'];
        $data['banner_image_webp'] = !empty($id) && !empty($savedData['banner_image_webp']) ? '' : $savedData['banner_image_webp'];
        $data['banner_image_alt'] = $savedData['banner_image_alt']??'';
        $data['status'] = $savedData['status']??'Active';
        adminView('add-area-seo-page', $data);
    }
    public function save_area_seo_page() {
        $post = $this->request->getVar();
        $id = !empty($post['id']) ? $post['id'] : '';
        $data = [];
        $data['page_name'] = trim($post['page_name']);
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
        if ($duplicate && ($id === '' || $duplicate['id'] !== $id)) {
            $this->session->setFlashdata('failed', 'Duplicate Entry');
            return redirect()->to(base_url(ADMINPATH . 'area-seo-page-list'));
        }
        if ($file = $this->request->getFile('banner_image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file(ROOTPATH . 'uploads/' . $post['old_jpg_image']) && file_exists(ROOTPATH . 'uploads/' . $post['old_jpg_image'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_jpg_image']);
                }
                if (is_file(ROOTPATH . 'uploads/' . $post['old_webp_image']) && file_exists(ROOTPATH . 'uploads/' . $post['old_webp_image'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_webp_image']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $webp_image = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['banner_image_jpg'] = $filename;
                $data['banner_image_webp'] = $webp_image;
            }
        }
        $filename = !empty($data['banner_image_jpg']) ? $data['banner_image_jpg'] : $post['old_jpg_image'];
        $data['slug'] = validate_slug(trim($post['slug']));
        $data['meta_title'] = trim($post['meta_title']);
        $data['faq_heading'] = trim($post['faq_heading']);
        $data['meta_description'] = trim($post['meta_description']);
        $data['meta_keyword'] = trim($post['meta_keyword']);
        $data['meta_schema'] = empty(($post['meta_schema'])) ? generateProductSchema(trim($post['page_name']), $filename, trim($post['meta_description'])) : trim($post['meta_schema']);
        $data['h1'] = trim($post['h1']);
        $data['seo_page_id'] = trim($post['seo_page_id']);
        $data['state_id'] = trim($post['state_id']);
        $data['city_id'] = trim($post['city_id']);
        $data['area_id'] = trim($post['area_id']);
        $data['description'] = trim($post['description']);
        $data['banner_image_alt'] = trim($post['banner_image_alt']);
        $data['status'] = trim($post['status']);
        if (empty($id)) {
            $data['add_date'] = date('Y-m-d H:i:s');
            $last_id = $this->c_model->insertRecords($this->table, $data);
            $this->session->setFlashData('success', 'Data Added Successfully');
        } else {
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $last_id = $id;
            $this->session->setFlashData('success', 'Data Updated Successfully');
        }
        $faq_data = [];
        $count = count($post["faq_question"]);
        for ($i = 0;$i < $count;$i++) {
            if ($post["faq_question"][$i] == "" || $post["faq_answer"][$i] == "") {
                continue;
            }
            $arr = ["table_id" => $last_id, 'table_name' => $this->table, "question" => $post["faq_question"][$i], "answer" => $post["faq_answer"][$i], "add_date" => date('Y-m-d H:i:s') ];
            array_push($faq_data, $arr);
        }
        if (count($faq_data) > 0) {
            $del = $this->c_model->deleteRecords("faq_master", ['table_id' => $last_id, 'table_name' => $this->table]);
            if ($del == true) {
                $data['faq_schema'] = generateFaqSchema($faq_data);
                $this->c_model->updateRecords($this->table, $data, ['id' => $last_id]);
                $this->c_model->insertBatchItems("faq_master", $faq_data);
            }
        }
        return redirect()->to(base_url(ADMINPATH . 'area-seo-page-list'));
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
            $where["page_name LIKE '%" . $searchString . "%'"] = null;
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
        $url = base_url();
        $select = '*,CONCAT("' . $url . '",slug) as page_url,DATE_FORMAT(add_date , "%d-%m-%Y %r") AS add_date,DATE_FORMAT(update_date , "%d-%m-%Y %r") AS update_date';
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