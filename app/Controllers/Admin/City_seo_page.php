<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class City_seo_page extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_city_area_seo_pages';
    }
    public function index() {
        $data['menu'] = 'Configure Seo Page';
        $data['title'] = 'Create Page';
        $data['state_list'] = $this->c_model->getAllData('state_list', 'id,state_name', ['status' => 'Active']);
        adminView('create-seo-page', $data);
    }
    public function city_seo_page_list() {
        $data['menu'] = 'City Area Seo Master';
        $data['title'] = 'City Area Seo Pages List';
        adminView('city-seo-pages-list', $data);
    }
    function edit_city_seo_page() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "City Area Seo Pages";
        $data["title"] = !empty($id) ? "Edit City Area Seo Page" : "Add City Area Seo Page";
        $data['faqs'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['status' => 'Active', 'table_id' => $id, 'table_name' => $this->table]);
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['meta_title'] = !empty($savedData['meta_title']) ? $savedData['meta_title'] : '';
        $data['meta_description'] = !empty($savedData['meta_description']) ? $savedData['meta_description'] : '';
        $data['meta_keyword'] = !empty($savedData['meta_keyword']) ? $savedData['meta_keyword'] : '';
        $data['h1'] = !empty($savedData['h1']) ? $savedData['h1'] : '';
        $data['display_name'] = !empty($savedData['display_name']) ? $savedData['display_name'] : '';
        $data['slug'] = !empty($savedData['slug']) ? $savedData['slug'] : '';
        $data['description'] = !empty($savedData['description']) ? $savedData['description'] : '';
        $data['image_jpg'] = !empty($savedData['image_jpg']) ? $savedData['image_jpg'] : '';
        $data['image_webp'] = !empty($savedData['image_webp']) ? $savedData['image_webp'] : '';
        $data['image_alt'] = !empty($savedData['image_alt']) ? $savedData['image_alt'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('edit-city-seo-page', $data);
    }
    public function update_city_seo_page() {
        $post = $this->request->getPost();
        
        $id = !empty($post['id']) ? $post['id'] : '';
        $data = [];
    
        // Handle image upload
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                
                if (is_file(ROOTPATH . 'uploads/' . $post['old_image_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_image_jpg']);
                }
                if (is_file(ROOTPATH . 'uploads/' . $post['old_image_webp'])) {
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
        $data['display_name'] = trim($post['display_name']);
        $data['meta_description'] = trim($post['meta_description']);
        $data['meta_keyword'] = trim($post['meta_keyword']);
        $data['h1'] = trim($post['h1']);
        $data['description'] = trim($post['description']);
        $data['image_alt'] = trim($post['image_alt']);
        $data['status'] = trim($post['status']);
        $data['update_date'] = date('Y-m-d H:i:s');
    
        $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
        $last_id = $id;
        $this->session->setFlashData('success', 'Data Updated Successfully');
    
        $faq_data = [];
        $count = count($post["faq_question"]);
        for ($i = 0; $i < $count; $i++) {
            if ($post["faq_question"][$i] == "" || $post["faq_answer"][$i] == "") {
                continue;
            }
            $arr = ["table_id" => $last_id, 'table_name' => $this->table, "question" => $post["faq_question"][$i], "answer" => $post["faq_answer"][$i], "add_date" => date('Y-m-d H:i:s')];
            array_push($faq_data, $arr);
        }
    
        if (count($faq_data) > 0) {
            $del = $this->c_model->deleteRecords("faq_master", ['table_id' => $last_id, 'table_name' => $this->table]);
            if ($del == true) {
                $this->c_model->insertBatchItems("faq_master", $faq_data);
            }
        }
        return redirect()->to(base_url(ADMINPATH . 'city-seo-page-list'));
    }
    
    public function save_city_seo_page() {
        $post = $this->request->getPost();
        // echo "<pre>";
        // print_r($post);exit;
        $table = !empty($post['type']) ? $post['type'] : '';
        $table_id = !empty($post['type_id']) ? $post['type_id'] : '';
        $template = $this->c_model->getSingle('seo_templates', '*', ['table_id' => $table_id, 'table_name' => $table]);
        $faqs = $this->c_model->getAllData('faq_master', 'table_id,table_name,question,answer', ['table_id' => $table_id, 'table_name' => $table]);
        $areas = !empty($post['areas']) ? $post['areas'] : [];
        $cities = !empty($post['cities']) ? $post['cities'] : [];
 
        $type = '';
        if ($table == "dt_boards_list") {
            $type = getBoardName($table_id);
        } elseif ($table == "dt_class_list") {
            $type = getClassName($table_id);
        } elseif ($table == "dt_subject_list") {
            $type = getSubjectName($table_id);
        }
        $typeslug = validate_slug($type);
        $final_slugs = [];
        $faqBatch = [];
        if (!empty($post['city_id'])) {
            $cityslug = validate_slug(getCityName($post['city_id']));
            if (!empty($areas)) {
                foreach ($areas as $areavalue) {
                    $arvalue=explode(',',$areavalue);
                    $final_slug = $cityslug . '-' . $typeslug . '-' . validate_slug($arvalue[0]);
                  //  $final_slugs[] = rtrim($final_slug, '-');
                    $replace=$arvalue[0].','.getCityName($post['city_id']);
                    $data = [];
                    $data['slug'] = $final_slug;
                    $data['city_id']=$post['city_id'];
                    $data['area_id']=$arvalue[1];
                    $data['template_id'] = !empty($template['id']) ? $template['id'] : '';
                    $data['original_table_id'] = !empty($table_id) ? $table_id : '';
                    $data['template_table'] = $table;
                    $data['meta_title'] = !empty($template['meta_title']) ? str_replace('Area,City',$replace,$template['meta_title']) : '';
                    $data['meta_description'] = !empty($template['meta_description']) ? str_replace('Area,City',$replace,$template['meta_description']) : '';
                    $data['meta_keyword'] = !empty($template['meta_keyword']) ? str_replace('Area,City',$replace,$template['meta_keyword']) : '';
                    $data['h1'] = !empty($template['h1']) ? str_replace('Area,City',$replace,$template['h1']) : '';
                    $data['display_name'] = !empty($template['display_name']) ? str_replace('Area,City',$replace,$template['display_name']) : '';
                    $data['description'] = !empty($template['description']) ? str_replace('Area,City',$replace,$template['description']) : '';
                    $data['image_jpg'] = !empty($template['image_jpg']) ? $template['image_jpg'] : '';
                    $data['image_webp'] = !empty($template['image_webp']) ? $template['image_webp'] : '';
                    $data['image_alt'] = !empty($template['image_alt']) ? str_replace('Area,City',$replace,$template['image_alt']) : '';
                    $data['add_date'] = date('Y-m-d H:i:s');
                    if(empty($check['id'])){
                        $last_id = $this->c_model->insertRecords($this->table, $data);
                        if (!empty($faqs)) {
                            foreach ($faqs as $key => $value) {
                                $faq_data = [];
                                $faq_data['table_id'] = $last_id;
                                $faq_data['table_name'] = $this->table;
                                $faq_data['question'] =  str_replace('Area,City',$replace,$value['question']);
                                $faq_data['answer'] = str_replace('Area,City',$replace,$value['answer']);
                                $faq_data['add_date'] = date('Y-m-d H:i:s');
                                $faqBatch[] = $faq_data;
                            }
                        }
                    }
                }
                
            }
        } else {
            if (!empty($cities)) {
                foreach ($cities as $cityvalue) {
                    $citvalue=explode(',',$cityvalue);
                    $final_slug = validate_slug($citvalue[0]) . '-' . $typeslug;

                    $replace=$citvalue[0];
                    $data = [];
                    $data['slug'] = $final_slug;
                    $data['city_id'] = $citvalue[1];
                    $data['template_id'] = !empty($template['id']) ? $template['id'] : '';
                    $data['original_table_id'] = !empty($table_id) ? $table_id : '';
                    $data['template_table'] = $table;
                    $data['meta_title'] = !empty($template['meta_title']) ? str_replace('Area,City',$replace,$template['meta_title']) : '';
                    $data['meta_description'] = !empty($template['meta_description']) ? str_replace('Area,City',$replace,$template['meta_description']) : '';
                    $data['meta_keyword'] = !empty($template['meta_keyword']) ? str_replace('Area,City',$replace,$template['meta_keyword']) : '';
                    $data['h1'] = !empty($template['h1']) ? str_replace('Area,City',$replace,$template['h1']) : '';
                    $data['display_name'] = !empty($template['display_name']) ? str_replace('Area,City',$replace,$template['display_name']) : '';
                    $data['description'] = !empty($template['description']) ? str_replace('Area,City',$replace,$template['description']) : '';
                    $data['image_jpg'] = !empty($template['image_jpg']) ? $template['image_jpg'] : '';
                    $data['image_webp'] = !empty($template['image_webp']) ? $template['image_webp'] : '';
                    $data['image_alt'] = !empty($template['image_alt']) ? str_replace('Area,City',$replace,$template['image_alt']) : '';
                    $data['add_date'] = date('Y-m-d H:i:s');
                    $check=$this->c_model->getSingle($this->table,'id',['slug'=>$final_slug]);
                    if(empty($check['id'])){
                        $last_id = $this->c_model->insertRecords($this->table, $data);
                        if (!empty($faqs)) {
                            foreach ($faqs as $key => $value) {
                                $faq_data = [];
                                $faq_data['table_id'] = $last_id;
                                $faq_data['table_name'] = $this->table;
                                $faq_data['question'] =  str_replace('Area,City',$replace,$value['question']);
                                $faq_data['answer'] = str_replace('Area,City',$replace,$value['answer']);
                                $faq_data['add_date'] = date('Y-m-d H:i:s');
                                $faqBatch[] = $faq_data;
                            }
                        }
                    }
                    
                }
               
            }
        }
        if (count($faqBatch) > 0) {
            $del = $this->c_model->deleteRecords("faq_master", ["table_name" => $this->table, "table_id" => $last_id]);
            $this->c_model->insertBatchItems("faq_master", $faqBatch);
        }
        $this->session->setFlashData('success', 'Page Configured Successfully');
        return redirect()->to(base_url(ADMINPATH . 'configure-city-seo-page'));
        
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
            $where[" display_name LIKE '%" . $searchString . "%'"] = null;
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
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id', null);
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
