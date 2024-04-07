<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Banner extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_banner_list';
    }
    public function index() {
        $data['menu'] = 'Banner Master';
        $data['title'] = 'Banner List';
        adminView('banner-list', $data);
    }
    function add_banner() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Banner Master";
        $data["title"] = !empty($id)?"Edit Banner":"Add Banner";
        $data['state_list'] = $this->c_model->getAllData('state_list', 'id,state_name', ['status' => 'Active']);
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['state_id'] = !empty($savedData['state_id']) ? $savedData['state_id'] : '';
        $data['city_id'] = !empty($savedData['city_id']) ? $savedData['city_id']:'';
        $data['banner_image_jpg'] = !empty($savedData['banner_image_jpg']) ? $savedData['banner_image_jpg'] : '';
        $data['banner_image_webp'] = !empty($savedData['banner_image_webp']) ? $savedData['banner_image_webp'] : '';
        $data['banner_image_alt'] = !empty($savedData['banner_image_alt']) ? $savedData['banner_image_alt'] : '';
        $data['slug'] = !empty($savedData['slug']) ? $savedData['slug'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('add-banner', $data);
    }
    public function save_banner() {
        $post = $this->request->getVar();
        // echo "<pre>";
        // print_r($post);exit;
        $id = !empty($post['id']) ? $post['id'] : '';
        $data = [];
        
        $data['state_id'] = trim($post['state_id']);
        $data['slug'] = validate_slug(trim($post['slug']));
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
    
        if ($duplicate && ($id === '' || $duplicate['id'] !== $id)) {
            $this->session->setFlashData('failed', 'Duplicate Entry');
            return redirect()->to(base_url(ADMINPATH.'banner-list'));
        }
        if ($file = $this->request->getFile('image')) {
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
        $data['city_id'] = !empty($post['city_id'])?implode(',',$post['city_id']):'';
        $data['status'] = trim($post['status']);
        $data['banner_image_alt'] = trim($post['banner_image_alt']);
    
        if (empty($id)) {
            $data['add_date']=date('Y-m-d H:i:s');
            $last_id = $this->c_model->insertRecords($this->table, $data);
            $this->session->setFlashData('success', 'Data Updated Successfully');
        } else {
            $data['update_date']=date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $last_id = $id;
            $this->session->setFlashData('success', 'Data Updated Successfully');
        }
    
       return redirect()->to(base_url(ADMINPATH.'banner-list'));
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
            $where[" slug LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_banner_list as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';

        $select = 'a.*, DATE_FORMAT(a.add_date , "%d-%m-%Y %r") AS add_date, DATE_FORMAT(a.update_date , "%d-%m-%Y %r") AS update_date, b.state_name';

        $listData = $this->c_model->getAllData(
            $this->table,
            $select,
            $where,
            $limit,
            $start,
            $orderby,
            'id',
            null,
            $joinArray
        );

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