<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Subject extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_subject_list';
    }
    public function index() {
        $data['menu'] = 'Subject Master';
        $data['title'] = 'Subject List';
        adminView('subject-list', $data);
    }
    function add_subject() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Subject Master";
        $data["title"] = !empty($id) ? "Edit Subject" : "Add Subject";
        $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active']);
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['subject_name'] = !empty($savedData['subject_name']) ? $savedData['subject_name'] : '';
        $data['image_jpg'] = !empty($savedData['image_jpg']) ? $savedData['image_jpg'] : '';
        $data['image_webp'] = !empty($savedData['image_webp']) ? $savedData['image_webp'] : '';
        $data['image_alt'] = !empty($savedData['image_alt']) ? $savedData['image_alt'] : '';
        $data['class_id'] = !empty($savedData['class_id']) ? $savedData['class_id'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('add-subject', $data);
    }
    public function save_subject() {
        $post = $this->request->getVar();
        $id = !empty($post['id']) ? $post['id'] : '';
        $data = [];
        $data['subject_name'] = ucwords(trim($post['subject_name']));
        $data['class_id'] = trim($post['class_id']);
        $duplicate = $this->c_model->getSingle($this->table, 'id', $data);
        if ($duplicate && ($id === '' || $duplicate['id'] !== $id)) {
            $this->session->setFlashData('failed', 'Duplicate Entry');
            return redirect()->to(base_url(ADMINPATH . 'subject-list'));
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
                $data['image_jpg'] = $filename;
                $data['image_webp'] = $webp_image;
            }
        }
        $data['status'] = trim($post['status']);
        $data['image_alt'] = trim($post['image_alt']);
        if (empty($id)) {
            $data['add_date'] = date('Y-m-d H:i:s');
            $last_id = $this->c_model->insertRecords($this->table, $data);
            $this->session->setFlashData('success', 'Data Updated Successfully');
        } else {
            $data['update_date'] = date('Y-m-d H:i:s');
            $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $last_id = $id;
            $this->session->setFlashData('success', 'Data Updated Successfully');
        }
        return redirect()->to(base_url(ADMINPATH . 'subject-list'));
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
            $where[" dt_subject_list.subject_name LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_subject_list as a';
        $joinArray[0]['table'] = 'dt_class_list as b';
        $joinArray[0]['join_on'] = 'a.class_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $select = 'a.*, DATE_FORMAT(a.add_date , "%d-%m-%Y %r") AS add_date, DATE_FORMAT(a.update_date , "%d-%m-%Y %r") AS update_date, b.class_name';
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
}
?>