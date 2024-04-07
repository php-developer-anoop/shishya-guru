<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Profile extends BaseController {
    public $c_model;
    protected $session;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
    }
    public function index() {
        $data['meta_title'] = 'My Profile - Tutor Panel';
        $data['meta_description'] = 'My Profile - Tutor Panel';
        $data['meta_keyword'] = 'My Profile - Tutor Panel';
        $table = 'dt_city_list as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $data['city_list'] = $this->c_model->getAllData($table, 'a.id,a.state_id,a.city_name,b.state_name', ['a.status' => 'Active'], null, null, null, null, null, $joinArray);
        $data['qualification_list'] = $this->c_model->getAllData('qualification_list', 'id,qualification_name', ['status' => 'Active']);
        $data['skill_list'] = $this->c_model->getAllData('skill_list', 'id,skill_name', ['status' => 'Active']);
        $data['board_list'] = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active']);
        $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active']);
        tutorView('profile', $data);
    }
    public function save_personal_info() {
        $post = $this->request->getPost();
        $response = [];
        $tutor_slug = 'tutor/' . validate_slug(getCityName($post['city'])) . '/' . validate_slug($post['name']);
        $data = ['tutor_name' => !empty($post['name']) ? $post['name'] : '','tutor_slug'=>!empty($tutor_slug)?$tutor_slug:'', 'mobile_no' => !empty($post['mobile_no']) ? $post['mobile_no'] : '', 'dob' => !empty($post['dob']) ? $post['dob'] : '', 'gender' => !empty($post['gender']) ? $post['gender'] : '', 'email' => !empty($post['email']) ? $post['email'] : '', 'city' => !empty($post['city']) ? $post['city'] : '', 'pincode' => !empty($post['pincode']) ? $post['pincode'] : '', 'address' => !empty($post['address']) ? $post['address'] : '', ];
        $this->c_model->updateRecords('tutor_list', $data, ['id' => $post['tutor_id']]);
        $response['status'] = true;
        $response['message'] = 'Personal Info Saved Successfully';
        echo json_encode($response);
        exit;
    }
    public function save_education_info() {
        $post = $this->request->getPost();
        $response = [];
        $data = ['qualification' => !empty($post['qualification']) ? $post['qualification'] : '', 'skill' => !empty($post['skill']) ? implode(',',$post['skill']) : '', 'experience_years' => !empty($post['experience_years']) ? $post['experience_years'] : '', 'is_experienced' => isset($post['is_experienced']) ? 'Yes' : 'No','form_step'=>'3' ];
        $this->c_model->updateRecords('tutor_list', $data, ['id' => $post['tutor_id']]);
        $response['status'] = true;
        $response['message'] = 'Education Info Saved Successfully';
        echo json_encode($response);
        exit;
    }

    public function save_tuition_info() {
        $post = $this->request->getPost();
        // echo "<pre>";
        // print_r($post);exit;
        $response = [];
        $data = ['tuition_mode' => !empty($post['tuition_mode']) ? $post['tuition_mode'] : '', 'board' => !empty($post['board']) ? implode(',',$post['board']) : '', 'class' => !empty($post['class_id']) ? implode(',',$post['class_id']) : '','subject' => !empty($post['subject']) ? implode(',',$post['subject']) : '','monthly_fees' => !empty($post['tuition_fee']) ? $post['tuition_fee'] : '','form_step'=>'4' ];
        $this->c_model->updateRecords('tutor_list', $data, ['id' => $post['tutor_id']]);
        $response['status'] = true;
        $response['message'] = 'Tuition Info Saved Successfully';
        echo json_encode($response);
        exit;
    }
    public function save_additional_info() {
        $post = $this->request->getPost();
        $response = [];
        $data = ['about_heading' => !empty($post['about_heading']) ? $post['about_heading'] : '', 'about_description' => !empty($post['about_description']) ? $post['about_description'] : '', 'payment_mode' => !empty($post['payment_mode']) ? implode(',',$post['payment_mode']) : '','days' => !empty($post['days']) ? $post['days'] : '','form_step'=>'5' ];
        $this->c_model->updateRecords('tutor_list', $data, ['id' => $post['tutor_id']]);
        $response['status'] = true;
        $response['message'] = 'Additional Info Saved Successfully';
        echo json_encode($response);
        exit;
    }
    public function save_kyc_image() { 
        $post = $this->request->getPost();
        if ($file = $this->request->getFile('image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (!empty($post['old_image']) && is_file(ROOTPATH . 'uploads/' . $post['old_image']) && file_exists(ROOTPATH . 'uploads/' . $post['old_image'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_image']);
                }
                $file->move(ROOTPATH . 'uploads/', $filename);
                $data[$post['type']] = $filename;
               
                $this->c_model->updateRecords('tutor_list', $data, ['id' => $post['tutor_id']]);
                echo "Image Uploaded Successfully";
            } else {
                echo "Invalid file.";
            }
        } else {
            echo "No file uploaded.";
        }
    }
    public function setting(){
        $data['meta_title'] = 'Setting - Tutor Panel';
        $data['meta_description'] = 'Setting - Tutor Panel';
        $data['meta_keyword'] = 'Setting - Tutor Panel';
        tutorView('setting', $data);
    }
    public function save_setting() {
        $post = $this->request->getPost();
        $password = !empty($post['password']) ? trim($post['password']) : '';
        $tutor_id = !empty($post['tutor_id']) ? $post['tutor_id'] : '';
    
        $response = [];
    
        if (empty($password)) {
            $response['status'] = false;
            $response['message'] = 'Enter Password';
            echo json_encode($response);
            exit;
        }
    
        $data = ['enc_password' => md5($password)];
    
        $this->c_model->updateRecords('tutor_list', $data, ['id' => $tutor_id]);
    
        $email = !empty($tutor_id) ? getEmailId($tutor_id) : '';
        if(!empty($email)){
            sendEmailForgotPassword($email,$password);
        }
        
    
        $response['status'] = true;
        $response['message'] = 'Password Changed Successfully';
        echo json_encode($response);
        exit;
    }
    
}
?>