<?php
namespace App\Controllers;
use App\Models\Common_model;
class User extends BaseController {
    public $c_model;
    protected $session;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
    }
    public function index() {
        $data = [];
        $mobile_no = $this->request->getPost('mobile_no');
        $response = [];
        if (empty($mobile_no)) {
            $response['status'] = false;
            $response['message'] = 'Mobile number is blank';
        } else {
            $mobile_no = trim($mobile_no);
            $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $check = $this->c_model->getSingle('user_list', 'id', ['mobile_no' => $mobile_no]);
            if (!empty($check['id'])) {
                $this->c_model->updateRecords('user_list', ['otp' => $otp, 'otp_sent_at' => date('Y-m-d H:i:s') ], ['mobile_no' => $mobile_no]);
            } else {
                $user_id = $this->c_model->insertRecords('user_list', ['mobile_no' => $mobile_no, 'otp' => $otp, 'otp_sent_at' => date('Y-m-d H:i:s'), 'add_date' => date('Y-m-d H:i:s') ]);
            }
            $res = sendOtpPhone($mobile_no, $otp);
            $response['status'] = true;
            $response['otp'] = $otp;
            $response['message'] = '4 Digit OTP Sent To ' . $mobile_no;
        }
        echo json_encode($response);
        exit();
    }
    public function validateOtp() {
        $post = $this->request->getPost();
        $entered_otp = !empty($post['entered_otp']) ? trim($post['entered_otp']) : '';
        $sent_otp = !empty($post['sent_otp']) ? trim($post['sent_otp']) : '';
        $mobile_no = !empty($post['mobile_no']) ? trim($post['mobile_no']) : '';
        $response = [];
        if (empty($entered_otp)) {
            $response['status'] = false;
            $response['message'] = 'Otp Is Blank';
            echo json_encode($response);
            exit;
        }
        if ((strlen($entered_otp) !== 4) || ($entered_otp !== $sent_otp)) {
            $response['status'] = false;
            $response['message'] = 'Incorrect OTP';
            echo json_encode($response);
            exit;
        }
        $this->c_model->updateRecords('user_list', ['otp' => ''], ['mobile_no' => $mobile_no]);
        $response['status'] = true;
        $response['message'] = 'OTP Verified Successfully';
        echo json_encode($response);
        exit;
    }
    function validateReview() {
        $post = $this->request->getPost();
        $response = [];
        $rating = !empty($post['user_rating']) ? (int)trim($post['user_rating']) : '';
        $name = !empty($post['user_name']) ? trim($post['user_name']) : '';
        $location = !empty($post['user_location']) ? trim($post['user_location']) : '';
        $review = !empty($post['user_review']) ? trim($post['user_review']) : '';
        $tutor_id = !empty($post['tutor_id']) ? trim($post['tutor_id']) : '';
        $tutor = !empty($post['tutor']) ? trim($post['tutor']) : '';
        if (empty($rating)) {
            $response['status'] = false;
            $response['message'] = 'Please Select Rating';
            echo json_encode($response);
            exit;
        }
        if (empty($name)) {
            $response['status'] = false;
            $response['message'] = 'Please Enter Name';
            echo json_encode($response);
            exit;
        }
        if (empty($location)) {
            $response['status'] = false;
            $response['message'] = 'Please Enter Location';
            echo json_encode($response);
            exit;
        }
        if (empty($review)) {
            $response['status'] = false;
            $response['message'] = 'Please Enter Review';
            echo json_encode($response);
            exit;
        }
        $saveData = [];
        $saveData['name'] = $name;
        $saveData['testimonial'] = $review;
        $saveData['location'] = $location;
        $saveData['rating'] = $rating;
        $saveData['tutor_id'] = $tutor_id;
        $saveData['tutor'] = $tutor;
        $saveData['status'] = 'Inactive';
        $saveData['add_date'] = date('Y-m-d H:i:s');
        $this->c_model->insertRecords('testimonial_list', $saveData);
        
        $response['status'] = true;
        $response['message'] = 'Review Submitted Successfully';
        echo json_encode($response);
        exit;
    }
    function validateResendOtp() {
        $post = $this->request->getPost();
        $mobile_no = isset($post['mobile_no']) ? trim($post['mobile_no']) : '';
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
        $this->c_model->updateRecords('user_list', ['otp' => $otp, 'otp_sent_at' => date('Y-m-d H:i:s') ], ['mobile_no' => $mobile_no]);
        $res = sendOtpPhone($mobile_no, $otp);
        $response['status'] = true;
        $response['message'] = 'Resent Otp';
        $response['otp'] = $otp;
        echo json_encode($response);
        exit;
    }
}
