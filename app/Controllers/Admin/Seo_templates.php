<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Seo_templates extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_seo_templates';
    }
    
    function index() {
        $table_id = !empty($this->request->getVar('table_id')) ? $this->request->getVar('table_id') : '';
        $table_name = !empty($this->request->getVar('table_name')) ? $this->request->getVar('table_name') : '';
      
        $data = [];
        $data["menu"] = "Seo Template";
        $data["title"] = !empty($id)?"Edit Seo Template":"Add Seo Template";
       
        $data['faqs']=$this->c_model->getAllData('faq_master','id,question,answer',['status'=>'Active','table_id'=>$table_id,'table_name'=>$table_name]);
        $savedData = $this->c_model->getSingle($this->table, '*', ['table_id' => $table_id,'table_name'=>$table_name]);
        $data['table_id'] = $table_id;
        $data['table_name'] = $table_name;
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : '';
        $data['slug'] = !empty($savedData['slug']) ? $savedData['slug'] : '';
        $data['meta_title'] = !empty($savedData['meta_title']) ? $savedData['meta_title'] : '';
        $data['meta_description'] = !empty($savedData['meta_description']) ? $savedData['meta_description'] : '';
        $data['meta_keyword'] = !empty($savedData['meta_keyword']) ? $savedData['meta_keyword'] : '';
        $data['display_name'] = !empty($savedData['display_name']) ? $savedData['display_name'] : '';
        $data['posted_by'] = !empty($savedData['posted_by']) ? $savedData['posted_by'] : '';
       // $data['meta_schema'] = !empty($savedData['meta_schema']) ? $savedData['meta_schema'] : '';
       // $data['faq_schema'] = !empty($savedData['faq_schema']) ? $savedData['faq_schema'] : '';
        $data['h1'] = !empty($savedData['h1']) ? $savedData['h1'] : '';
        $data['description'] = !empty($savedData['description']) ? $savedData['description'] : '';
        $data['image_jpg'] = !empty($savedData['image_jpg']) ? $savedData['image_jpg'] : '';
        $data['image_webp'] = !empty($savedData['image_webp']) ? $savedData['image_webp'] : '';
        $data['image_alt'] = !empty($savedData['image_alt']) ? $savedData['image_alt'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('add-seo-template', $data);
    }
    public function save_seo_template() {

        $post = $this->request->getPost();
        // echo "<pre>";
        // print_r($post);exit;
        $id = !empty($post['id']) ? $post['id'] : '';
        $table_id = !empty($post['table_id']) ? trim($post['table_id']) : '';
        $table_name = !empty($post['table_name']) ? trim($post['table_name']) : '';
        $data = [];
    
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file(ROOTPATH . 'uploads/' . $post['old_image_jpg']) && file_exists(ROOTPATH . 'uploads/' . $post['old_image_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_image_jpg']);
                }
                if (is_file(ROOTPATH . 'uploads/' . $post['old_image_webp']) && file_exists(ROOTPATH . 'uploads/' . $post['old_image_webp'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_image_webp']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $webp_image = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['image_jpg'] = $filename;
                $data['image_webp'] = $webp_image;
    
            }
        }
        $data['slug'] = validate_slug(trim($post['slug']));
        $data['meta_title'] = trim($post['meta_title']);
        $data['posted_by'] = trim($post['posted_by']);
        $data['display_name'] = trim($post['display_name']);
        $data['meta_description'] = trim($post['meta_description']);
        $data['meta_keyword'] = trim($post['meta_keyword']);
        $data['h1'] = trim($post['h1']);
        $data['description'] = trim($post['description']);
        $data['image_alt'] = trim($post['image_alt']);
        $data['status'] = trim($post['status']);
        $data['table_id'] = $table_id;
        $data['table_name'] = $table_name;
    
        if (empty($id)) {
            $data['add_date'] = date('Y-m-d H:i:s');
             $this->c_model->insertRecords($this->table, $data);
             $this->c_model->updateRecords($table_name, ['is_seo_added'=>'Yes'], ['id' => $table_id]);
            $this->session->setFlashData('success', 'Data Added Successfully');
        } else {
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['table_id' => $table_id, 'table_name' => $table_name]);
            
            $this->session->setFlashData('success', 'Data Updated Successfully');
        }
    
        $faq_data = [];
        $count = count($post["faq_question"]);
        for ($i = 0; $i < $count; $i++) {
            if ($post["faq_question"][$i] == "" || $post["faq_answer"][$i] == "") {
                continue;
            }
            $arr = ["table_id" => $table_id, 'table_name' => $table_name, "question" => $post["faq_question"][$i], "answer" => $post["faq_answer"][$i], "add_date" => date('Y-m-d H:i:s')];
            array_push($faq_data, $arr);
        }
        if (count($faq_data) > 0) {
            $del = $this->c_model->deleteRecords("faq_master", ['table_id' => $table_id, 'table_name' => $table_name]);
            if ($del == true) {
                $this->c_model->insertBatchItems("faq_master", $faq_data);
            }
        }
    
        // Redirect based on the table
        if($table_name=="dt_boards_list"){
            $url='board-list';
        }
        if($table_name=="dt_class_list"){
            $url='class-list';
        }
        if($table_name=="dt_subject_list"){
            $url='subject-list';
        }
        return redirect()->to(base_url(ADMINPATH . $url));
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
        $url=base_url();
        $select = '*,CONCAT("'.$url.'",slug) as page_url,DATE_FORMAT(add_date , "%d-%m-%Y %r") AS add_date,DATE_FORMAT(update_date , "%d-%m-%Y %r") AS update_date';
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