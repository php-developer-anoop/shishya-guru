<?php
namespace App\Controllers;
use App\Models\Common_model;
class Home extends BaseController {
    public $c_model;
    protected $session;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
    }
    public function index() {
        $data = [];
        $data['url'] = '';
        $data['company'] = websetting('*');
        $data['home'] = homesetting('*');
        $session_city = session()->get('session_city');
        $data['location'] = !empty($session_city) ? $session_city : '';
        $data['og_image'] = !empty($data['company']['logo_jpg']) && !empty($data['company']['logo_png']) ? base_url('uploads/') . imgExtension($data['company']['logo_jpg'], $data['company']['logo_png']) : '';
        $data['meta_title'] = !empty($data['home']['meta_title']) ? $data['home']['meta_title'] : '';
        $data['meta_description'] = !empty($data['home']['meta_title']) ? $data['home']['meta_title'] : '';
        $data['meta_keyword'] = !empty($data['home']['meta_title']) ? $data['home']['meta_title'] : '';
        $data['class_group_list'] = $this->c_model->getAllData('class_group_list', 'id,class_group_name', ['status' => 'Active']);
        $data['board_list'] = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active']);
        $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active']);
        $where = [];
        $where['status'] = 'Active';
        $where['kyc_status'] = 'Approved';
        if (!empty($session_city)) {
            $cityId = getCityIdFromName($session_city);
            $where['city'] = $cityId;
        }
        $joinArray = [];
        $table = 'dt_city_list as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $data['tutor_list'] = $this->c_model->getAllData('tutor_list', 'id,tutor_slug,tutor_name,profile_image,city,experience_years,gender,monthly_fees,subject,class,avg_rating,total_reviews', $where, 6, null, 'DESC', 'id');
        $data['location_list'] = $this->c_model->getAllData($table, 'a.id,a.state_id,a.city_name,b.state_name', ['a.status' => 'Active'], null, null, null, null, null, $joinArray);
        $data['subject_list'] = $this->c_model->getAllData('subject_list', 'subject_name,id,image_jpg,image_webp,image_alt', ['status' => 'Active'], null, null, null, null, 'subject_name');
        $data['city_list'] = $this->c_model->getAllData('city_list', 'id,city_name,state_id,jpg_image,webp_image', ['status' => 'Active', 'is_popular' => 'Yes']);
        $data['blog_list'] = $this->c_model->getAllData('blogs_list', 'id,blog_title,slug,created_date,blog_image_jpg,blog_image_webp,blog_image_alt', ['status' => 'Active']);
        $data['testimonial_list'] = $this->c_model->getAllData('testimonial_list', '*', ['status' => 'Active'], 2, null, 'DESC', 'id');
        frontView('index', $data);
    }
    public function sendOtp() {
        $post = $this->request->getPost();
        $mobile_no = isset($post['tutor_mobile']) ? trim($post['tutor_mobile']) : '';
        $email = isset($post['tutor_email']) ? trim($post['tutor_email']) : '';
        $response = [];
        if (empty($mobile_no)) {
            $response['status'] = false;
            $response['message'] = 'Mobile No. Is Empty';
            echo json_encode($response);
            exit;
        }
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $check = $this->c_model->getSingle('tutor_list', 'id,is_mobile_verified', ['mobile_no' => $mobile_no]);
        if (!empty($check)) {
            if ($check['is_mobile_verified'] == 'Yes') {
                $response['status'] = false;
                $response['message'] = 'This Mobile number is already registered and verified';
                echo json_encode($response);
                exit;
            } else {
                $this->c_model->updateRecords('tutor_list', ['otp' => $otp, 'otp_sent_at' => date('Y-m-d H:i:s'), 'email' => $email], ['id' => $check['id']]);
            }
        } else {
            $last_id = $this->c_model->insertRecords('tutor_list', ['mobile_no' => $mobile_no, 'otp' => $otp, 'otp_sent_at' => date('Y-m-d H:i:s'), 'email' => $email]);
        }
        $res = sendOtpPhone($mobile_no, $otp);
        sendUserEmailOtp($email, $email, $otp);
        if ($res) {
            $response['status'] = true;
            $response['message'] = '4 Digit OTP Sent To ' . $mobile_no . ' And On Email Id ' . $email;
            $response['otp'] = $otp;
        } else {
            $response['status'] = false;
            $response['message'] = 'Something Went Wrong';
        }
        echo json_encode($response);
        exit;
    }
    public function verifyOtp() {
        $post = $this->request->getPost();
        $otp = !empty($post['otp']) ? trim($post['otp']) : '';
        $sent_otp = !empty($post['sent_otp']) ? trim($post['sent_otp']) : '';
        $tutor_mobile = !empty($post['tutor_mobile']) ? trim($post['tutor_mobile']) : '';
        $tutor_email = !empty($post['tutor_email']) ? trim($post['tutor_email']) : '';
        $response = [];
        if (empty($otp)) {
            $response['status'] = false;
            $response['message'] = 'Otp is Blank';
            echo json_encode($response);
            exit;
        }
        if ((strlen($otp) !== 4) || ($otp !== $sent_otp)) {
            $response['status'] = false;
            $response['message'] = 'Incorrect OTP';
            echo json_encode($response);
            exit;
        }
        $email = $tutor_email;
        $password = generate_numeric_password(6);
        $data = [];
        $data['is_mobile_verified'] = 'Yes';
        $data['otp'] = '';
        $data['kyc_status'] = 'Pending';
        $data['form_step'] = '2';
        $data['enc_password'] = md5($password);
        $this->c_model->updateRecords('tutor_list', $data, ['mobile_no' => $tutor_mobile]);
        $tutorData = $this->c_model->getSingle('tutor_list', '*', ['mobile_no' => $tutor_mobile]);
        $sessionData = [];
        $sessionData['tutor_name']  = !empty($tutorData['tutor_name']) ? $tutorData['tutor_name'] : '';
        $sessionData['dob']         = !empty($tutorData['dob']) ? $tutorData['dob'] : '';
        $sessionData['gender']      = !empty($tutorData['gender']) ? $tutorData['gender'] : '';
        $sessionData['email']       = !empty($tutorData['email']) ? $tutorData['email'] : '';
        $sessionData['mobile_no']   = !empty($tutorData['mobile_no']) ? $tutorData['mobile_no'] : '';
        $sessionData['pincode']     = !empty($tutorData['pincode']) ? $tutorData['pincode'] : '';
        $sessionData['address']     = !empty($tutorData['address']) ? $tutorData['address'] : '';
        $sessionData['form_step']   = !empty($tutorData['form_step']) ? $tutorData['form_step'] : '';
        $sessionData['kyc_status']  = !empty($tutorData['kyc_status']) ? $tutorData['kyc_status'] : '';
        $this->session->set('tutor_login_data', $sessionData);
        if (!empty($email)) {
            sendEmailPassword($email, $email, $password);
        }
        $response['status'] = true;
        $response['goto'] = base_url(TUTORPATH . 'my-profile');
        $response['message'] = 'Mobile No. Verified Successfully<br>Login Credentials Sent On the registered mail';
        echo json_encode($response);
        exit;
    }
    public function checkUserVerification() {
        $post = $this->request->getPost();
        $fields = ['mobile_no', 'tutor_name', 'dob', 'gender', 'email', 'address', 'city', 'pincode'];
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = isset($post[$field]) ? trim($post[$field]) : '';
        }
        $tutor_slug = 'tutor/' . validate_slug(getCityName($post['city'])) . '/' . validate_slug($post['tutor_name']);
        $data['tutor_slug'] = $tutor_slug;
        $data['avg_rating'] = 4;
        $data['total_reviews'] = '15 reviews';
        $response = [];
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $response['status'] = false;
                $response['message'] = ucfirst(str_replace('_', ' ', $key)) . ' is blank';
                echo json_encode($response);
                exit;
            }
        }
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $data['otp'] = $otp;
        $data['otp_sent_at'] = date('Y-m-d H:i:s');
        $data['add_date'] = date('Y-m-d H:i:s');
        $data['unique_id'] = 'SG' . rand(00000, 99999);
        $check = $this->c_model->getSingle('tutor_list', 'id, is_mobile_verified', ['mobile_no' => $data['mobile_no']]);
        if (!empty($check)) {
            if ($check['is_mobile_verified'] == 'Yes') {
                $response['status'] = false;
                $response['message'] = 'This mobile number is already registered and verified';
                echo json_encode($response);
                exit;
            } else {
                $this->c_model->updateRecords('tutor_list', $data, ['id' => $check['id']]);
                $res = sendOtpPhone($data['mobile_no'], $otp);
                sendUserEmailOtp($data['email'], $data['email'], $otp);
                if ($res) {
                    $response['status'] = true;
                    $response['message'] = '4 Digit OTP Sent To ' . $data['mobile_no'] . ' And On Email Id ' . $data['email'];
                    $response['otp'] = $otp;
                    echo json_encode($response);
                    exit;
                } else {
                    $response['status'] = false;
                    $response['message'] = 'Something went wrong';
                    echo json_encode($response);
                    exit;
                }
            }
        } else {
            $last_id = $this->c_model->insertRecords('tutor_list', $data);
            $updateData = [];
            $updateData['tutor_slug'] = $tutor_slug . '/' . $last_id;
            $this->c_model->updateRecords('tutor_list', $updateData, ['id' => $last_id]);
            $res = sendOtpPhone($data['mobile_no'], $otp);
            sendUserEmailOtp($data['email'], $data['email'], $otp);
            if ($res) {
                $response['status'] = true;
                $response['message'] = '4 Digit OTP Sent To ' . $data['mobile_no'] . ' And On Email Id ' . $data['email'];
                $response['otp'] = $otp;
                echo json_encode($response);
                exit;
            } else {
                $response['status'] = false;
                $response['message'] = 'Something went wrong';
                echo json_encode($response);
                exit;
            }
        }
    }
    function resendOtp() {
        $post = $this->request->getPost();
        $mobile_no = isset($post['tutor_mobile']) ? trim($post['tutor_mobile']) : '';
        $email = isset($post['tutor_email']) ? trim($post['tutor_email']) : '';
        $response = [];
        if (empty($mobile_no)) {
            $response['status'] = false;
            $response['message'] = 'Mobile No. Is Empty';
            echo json_encode($response);
            exit;
        }
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $data['otp'] = $otp;
        $data['otp_sent_at'] = date('Y-m-d H:i:s');
        $this->c_model->updateRecords('tutor_list', ['otp' => $otp, 'otp_sent_at' => date('Y-m-d H:i:s'), 'email' => $email], ['mobile_no' => $mobile_no, 'email' => $email]);
        $res = sendOtpPhone($mobile_no, $otp);
        sendUserEmailOtp($email, $email, $otp);
        $response['status'] = true;
        $response['message'] = 'Resent Otp';
        $response['otp'] = $otp;
        echo json_encode($response);
        exit;
    }
}
