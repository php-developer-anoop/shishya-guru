<?php
namespace App\Controllers;
use App\Models\Common_model;
class Leads extends BaseController {
    public $c_model;
    public function __construct() {
        $this->c_model = new Common_model();
    }
    public function index() {
        $post = $this->request->getPost();
        // echo "<pre>";
        // print_r($post);exit;
        $response = [];
        $data = [];
        if ($post['csrf'] !== $post['match_captcha']) {
            $response['status'] = false;
            $response['message'] = 'Captcha Not Match';
            echo json_encode($response);
            exit;
        }
        $data['name']         = !empty($post['name']) ? testInput(trim($post['name'])) : '';
        $data['email']        = !empty($post['email']) ? testInput(trim($post['email'])) : '';
        $data['mobile_no']    = !empty($post['mobile_no']) ? testInput(trim($post['mobile_no'])) : '';
        $data['class_id']     = !empty($post['class_id']) ? testInput((trim($post['class_id']))) : '';
        $data['class_name']   = !empty($post['class_id']) ? testInput(getClassName(trim($post['class_id']))) : '';
        $data['subject_id']   = !empty($post['subject']) ? testInput((trim($post['subject']))) : '';
        $data['subject_name'] = !empty($post['subject']) ? testInput(getSubjectName(trim($post['subject']))) : '';
        $data['board_id']     = !empty($post['board']) ? testInput((trim($post['board']))) : '';
        $data['board_name']   = !empty($post['board']) ? testInput(getBoardName(trim($post['board']))) : '';
        $data['gender']       = !empty($post['gender']) ? testInput(trim($post['gender'])) : '';
        $data['city_id']      = !empty($post['city_id']) ? testInput(trim($post['city_id'])) : '';
        $data['city_name']    = !empty($post['city_id']) ? testInput(getCityName(trim($post['city_id']))) : '';
        $data['area']         = !empty($post['area']) ? testInput((trim($post['area']))) : '';
        $data['tuition_mode'] = !empty($post['tuition_mode']) ? testInput(trim($post['tuition_mode'])) : '';
        $data['add_date']     = date('Y-m-d H:i:s');
        
        $last_id = $this->c_model->insertRecords('leads_list', $data); 
        
        if ($last_id) {
            $response['status'] = true;
            $response['message'] = 'Query Saved Successfully';
            echo json_encode($response);
            exit;
        }
        $response['status'] = false;
        $response['message'] = 'Something Went Wrong';
        echo json_encode($response);
        exit;
    }
}
