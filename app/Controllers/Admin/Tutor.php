<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Tutor extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_tutor_list';
    }
    public function index() {
        $data['menu'] = 'Tutor';
        $data['title'] = 'Tutor List';
        adminView('tutor-list', $data);
    }
    function edit_tutor() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Tutor List";
        $data["title"] = !empty($id) ? "Edit Tutor" : "Add Tutor";
        $table = 'dt_city_list as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $data['city_list'] = $this->c_model->getAllData($table, 'a.id,a.city_name,b.state_name', ['a.status' => 'Active'],null,null,null,null,null,$joinArray);
        $data['board_list'] = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active']);
        $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active']);
        $data['qualification_list'] = $this->c_model->getAllData('qualification_list', 'id,qualification_name', ['status' => 'Active']);
        $data['skill_list'] = $this->c_model->getAllData('skill_list', 'id,skill_name', ['status' => 'Active']);
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['tutor_name'] = !empty($savedData['tutor_name']) ? $savedData['tutor_name'] : '';
        $data['dob'] = !empty($savedData['dob']) ? $savedData['dob'] : '';
        $data['mobile_no'] = !empty($savedData['mobile_no']) ? $savedData['mobile_no'] : '';
        $data['email'] = !empty($savedData['email']) ? $savedData['email'] : '';
        $data['city'] = !empty($savedData['city']) ? $savedData['city'] : '';
        $data['pincode'] = !empty($savedData['pincode']) ? $savedData['pincode'] : '';
        $data['address'] = !empty($savedData['address']) ? $savedData['address'] : '';
        $data['qualification'] = !empty($savedData['qualification']) ? $savedData['qualification'] : '';
        $data['gender'] = !empty($savedData['gender']) ? $savedData['gender'] : '';
        $data['skill'] = !empty($savedData['skill']) ? $savedData['skill'] : '';
        $data['is_experienced'] = !empty($savedData['is_experienced']) ? $savedData['is_experienced'] : '';
        $data['experience_years'] = !empty($savedData['experience_years']) ? $savedData['experience_years'] : '';
        $data['tuition_mode'] = !empty($savedData['tuition_mode']) ? $savedData['tuition_mode'] : '';
        $data['board'] = !empty($savedData['board']) ? $savedData['board'] : '';
        $data['class'] = !empty($savedData['class']) ? $savedData['class'] : '';
        $data['subject'] = !empty($savedData['subject']) ? $savedData['subject'] : '';
        $data['monthly_fees'] = !empty($savedData['monthly_fees']) ? (int)$savedData['monthly_fees'] : '';
        $data['profile_image'] = !empty($savedData['profile_image']) ? $savedData['profile_image'] : '';
        $data['aadhaar_front'] = !empty($savedData['aadhaar_front']) ? $savedData['aadhaar_front'] : '';
        $data['aadhaar_back'] = !empty($savedData['aadhaar_back']) ? $savedData['aadhaar_back'] : '';
        $data['about_heading'] = !empty($savedData['about_heading']) ? $savedData['about_heading'] : '';
        $data['about_description'] = !empty($savedData['about_description']) ? $savedData['about_description'] : '';
        $data['payment_mode'] = !empty($savedData['payment_mode']) ? $savedData['payment_mode'] : '';
        $data['days'] = !empty($savedData['days']) ? $savedData['days'] : '';
        $data['kyc_status'] = !empty($savedData['kyc_status']) ? $savedData['kyc_status'] : '';
        $data['meta_title'] = !empty($savedData['meta_title']) ? $savedData['meta_title'] : '';
        $data['meta_description'] = !empty($savedData['meta_description']) ? $savedData['meta_description'] : '';
        $data['meta_keyword'] = !empty($savedData['meta_keyword']) ? $savedData['meta_keyword'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('edit-tutor', $data);
    }
    public function save_tutor() {
        $post = $this->request->getPost();
        $saveData = [];
        // echo "<pre>";
        // print_r($post);exit;
        $id = !empty($post['id']) ? trim($post['id']) : '';
        $saveData['tutor_name'] = !empty($post['tutor_name']) ? trim($post['tutor_name']) : '';
        $saveData['dob'] = !empty($post['dob']) ? date('Y-m-d', strtotime(trim($post['dob']))) : '';
        $saveData['mobile_no'] = !empty($post['mobile_no']) ? trim($post['mobile_no']) : '';
        $saveData['gender'] = !empty($post['gender']) ? trim($post['gender']) : '';
        $saveData['email'] = !empty($post['email']) ? trim($post['email']) : '';
        $saveData['is_experienced'] = !empty($post['is_experienced']) ? trim($post['is_experienced']) : '';
        $saveData['experience_years'] = !empty($post['experience_years']) ? trim($post['experience_years']) : '';
        $saveData['tuition_mode'] = !empty($post['tuition_mode']) ? trim($post['tuition_mode']) : '';
        $saveData['board'] = !empty($post['board_id']) ? implode(',', ($post['board_id'])) : '';
        $saveData['class'] = !empty($post['class_id']) ? implode(',', ($post['class_id'])) : '';
        $saveData['subject'] = !empty($post['subject_id']) ? implode(',', ($post['subject_id'])) : '';
        $saveData['skill'] = !empty($post['skills']) ? implode(',', ($post['skills'])) : '';
        $saveData['days'] = !empty($post['days']) ? implode(',', ($post['days'])) : '';
        $saveData['city'] = !empty($post['city_id']) ? trim($post['city_id']) : '';
        $saveData['qualification'] = !empty($post['qualification']) ? trim($post['qualification']) : '';
        $saveData['address'] = !empty($post['address']) ? trim($post['address']) : '';
        $saveData['pincode'] = !empty($post['pincode']) ? trim($post['pincode']) : '';
        $saveData['meta_title'] = !empty($post['meta_title']) ? trim($post['meta_title']) : '';
        $saveData['meta_description'] = !empty($post['meta_description']) ? trim($post['meta_description']) : '';
        $saveData['meta_keyword'] = !empty($post['meta_keyword']) ? trim($post['meta_keyword']) : '';
        $saveData['about_heading'] = !empty($post['about_heading']) ? trim($post['about_heading']) : '';
        $saveData['about_description'] = !empty($post['about_description']) ? trim($post['about_description']) : '';
        $saveData['monthly_fees'] = !empty($post['tuition_fee']) ? trim($post['tuition_fee']) : '';
        $saveData['status'] = !empty($post['status']) ? trim($post['status']) : '';
        $saveData['kyc_status'] = !empty($post['kyc_status']) ? trim($post['kyc_status']) : '';
        if ($file = $this->request->getFile('profile_image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file(ROOTPATH . 'uploads/' . $post['old_profile_image']) && file_exists(ROOTPATH . 'uploads/' . $post['old_profile_image'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_profile_image']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $saveData['profile_image'] = $filename;
            }
        }
        if ($file = $this->request->getFile('aadhaar_front')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file(ROOTPATH . 'uploads/' . $post['old_aadhaar_front']) && file_exists(ROOTPATH . 'uploads/' . $post['old_aadhaar_front'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_aadhaar_front']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $saveData['aadhaar_front'] = $filename;
            }
        }
        if ($file = $this->request->getFile('aadhaar_back')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file(ROOTPATH . 'uploads/' . $post['old_aadhaar_back']) && file_exists(ROOTPATH . 'uploads/' . $post['old_aadhaar_back'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_aadhaar_back']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $saveData['aadhaar_back'] = $filename;
            }
        }
        if (!empty($id)) {
            $this->c_model->updateRecords($this->table, $saveData, ['id' => $id]);
        }
        $this->session->setFlashData('success', 'Data Updated Successfully');
        return redirect()->to(base_url(ADMINPATH . 'tutor-list'));
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
        if (!empty($get['type']) && $get['type'] == 'kyc_pending') {
            $where['kyc_status'] = 'Pending';
        }
        if (!empty($get['type']) && $get['type'] == 'kyc_completed') {
            $where['kyc_status'] = 'Approved';
        }
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where["tutor_name LIKE '%" . $searchString . "%' OR mobile_no LIKE '%" . $searchString . "%' OR dob LIKE '%" . $searchString . "%' OR email LIKE '%" . $searchString . "%' OR pincode LIKE '%" . $searchString . "%' OR gender LIKE '%" . $searchString . "%' OR qualification LIKE '%" . $searchString . "%' OR skill LIKE '%" . $searchString . "%' OR board LIKE '%" . $searchString . "%' OR class LIKE '%" . $searchString . "%' OR monthly_fees LIKE '%" . $searchString . "%' OR payment_mode LIKE '%" . $searchString . "%' OR days LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_tutor_list as a';
        $joinArray[0]['table'] = 'dt_city_list as b';
        $joinArray[0]['join_on'] = 'a.city = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $upload_url = base_url('uploads/');
        $select = 'a.*,CONCAT("' . $upload_url . '",a.profile_image) as profile_image,CONCAT("' . $upload_url . '",a.aadhaar_front) as aadhaar_front,CONCAT("' . $upload_url . '",a.aadhaar_back) as aadhaar_back, DATE_FORMAT(a.add_date, "%d-%m-%Y %r") AS add_date, b.city_name';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id', null, $joinArray);
        $result = [];
        if (!empty($listData)) {
            $i = $start + 1;
            foreach ($listData as $key => $value) {
                $push = [];
                $push = $value;
                $push["sr_no"] = $i;
                $push['matching_board_names'] = !empty($value['board']) ? getMultipleBoard($value['board']) : '';
                $push['class_name'] = !empty($value['class']) ? getMultipleClass($value['class']) : '';
                $push['subject_name'] = !empty($value['subject']) ? getMultipleSubject($value['subject']) : '';
                $push['skill_name'] = !empty($value['skill']) ? getMultipleSkill($value['skill']) : '';
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