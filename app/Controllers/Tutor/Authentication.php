<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Authentication extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    protected $cookieName;
    public function __construct() {
        $this->session = session();
        $this->table = 'dt_tutor_list';
        $this->cookieName = 'LoginStuck';
        $this->c_model = new Common_model();
    }
    public function index() {
        $rememberData = decryptPassword($this->cookieName, $_SERVER['HTTP_HOST']);
        // echo "<pre>";
        // print_r($rememberData);exit;
        $data["title"] = "Tutor Panel";
        $data['email'] = !empty($rememberData['ue']) ? $rememberData['ue'] : '';
        $data['password'] = !empty($rememberData['up']) ? $rememberData['up'] : '';
        echo view("tutor/sign_in", $data);
    }
    public function checkLogin() {
        $post = $this->request->getPost();
        // echo "<pre>";
        // print_r($post);exit;
        $response = [];
        $where = [];
        $email = !empty($post["email"]) ? trim($post["email"]) : "";
        $password = !empty($post["password"]) ? trim($post["password"]) : "";
        $is_remember = !empty($post["is_remember"]) ? trim($post["is_remember"]) : "";
        if (empty($email) || empty($password)) {
            $response['status'] = false;
            $response['message'] = 'Please Enter Valid Email Address and Password';
            echo json_encode($response);
            exit;
        }
        if ($is_remember) {
            $checkCookie = decryptPassword($this->cookieName, $_SERVER['HTTP_HOST']);
            if (empty($checkCookie)) {
                $cookieData = ['ue' => $email, 'up' => $password];
                encryptPassword($this->cookieName, $cookieData, $_SERVER['HTTP_HOST']);
            }
        }
        $where = ["email" => $email, "enc_password" => md5($password) ];
        $select = "*";
        $tutor = $this->c_model->getSingle($this->table, $select, $where);
        if (empty($tutor)) {
            $response['status'] = false;
            $response['message'] = 'Invalid Email or Password';
            echo json_encode($response);
            exit;
        } else if (!empty($tutor) && ($tutor['status'] !== 'Active')) {
            $response['status'] = false;
            $response['message'] = 'Your Profile is currently Inactive';
            echo json_encode($response);
            exit;
        }
        $deviceInfo = $this->getBrowserName();
        $ipAddress = $this->request->getIPAddress();
        $setLoginActivity = $this->addLoginActivity($tutor['id'], $ipAddress, $deviceInfo);
        $sessionData = ['id' => $tutor['id'], 'name' => $tutor['tutor_name'], 'dob' => $tutor['dob'], 'gender' => $tutor['gender'], 'email' => $tutor['email'], 'mobile_no' => $tutor['mobile_no'], 'city' => $tutor['city'], 'pincode' => $tutor['pincode'], 'address' => $tutor['address'], 'qualification' => $tutor['qualification'], 'skill' => $tutor['skill'], 'is_experienced' => $tutor['is_experienced'], 'experience_years' => $tutor['experience_years'], 'tuition_mode' => $tutor['tuition_mode'], 'board' => $tutor['board'], 'class' => $tutor['class'], 'monthly_fees' => $tutor['monthly_fees'], 'profile_image' => !empty($tutor['profile_image']) ? base_url('uploads/') . $tutor['profile_image'] : '', 'aadhaar_front' => !empty($tutor['aadhaar_front']) ? base_url('uploads/') . $tutor['aadhaar_front'] : '', 'aadhaar_back' => !empty($tutor['aadhaar_back']) ? base_url('uploads/') . $tutor['aadhaar_back'] : '', 'status' => $tutor['status'], 'is_mobile_verified' => $tutor['is_mobile_verified'], 'form_step' => $tutor['form_step'], 'activity_id' => $setLoginActivity['activity_id'], 'is_logged_in' => true];
        $this->session->set('tutor_login_data', $sessionData);
        $response['status'] = true;
        if ($tutor['kyc_status'] != "Approved") {
            $response['goto'] = base_url(TUTORPATH . 'my-profile');
        } else {
            $response['goto'] = base_url(TUTORPATH . 'dashboard');
        }
        $response['message'] = 'Logged in Successfully';
        echo json_encode($response);
        exit;
    }
    public function getBrowserName() {
        $data = [];
        $agent = $this->request->getUserAgent();
        $isMob = is_numeric(strpos(strtolower($agent), "mobile"));
        $isTab = is_numeric(strpos(strtolower($agent), "tablet"));
        $isWin = is_numeric(strpos(strtolower($agent), "windows"));
        $isAndroid = is_numeric(strpos(strtolower($agent), "android"));
        $isIPhone = is_numeric(strpos(strtolower($agent), "iphone"));
        $isIPad = is_numeric(strpos(strtolower($agent), "ipad"));
        $isIOS = $isIPhone || $isIPad;
        if ($isMob) {
            if ($isTab) {
                $data['device'] = 'Tablet';
            } else {
                $data['device'] = 'Mobile';
            }
        } else {
            $data['device'] = 'Desktop';
        }
        if ($isAndroid) {
            $data['os'] = 'Android';
        } elseif ($isWin) {
            $data['os'] = 'Windows';
        } else {
            $data['os'] = 'iOS';
        }
        return $data;
    }
    protected function addLoginActivity($userId, $ipAddress, $deviceInfo) {
        if ($ipAddress != '::1') {
            $ipDetails = file_get_contents("http://ip-api.com/json/" . $ipAddress);
        } else {
            $ipDetails = file_get_contents("http://ip-api.com/json/");
        }
        $ipLog = json_decode($ipDetails, true);
        $saveLog = [];
        $saveLog['user_type'] = 'Tutor';
        $saveLog['user_id'] = $userId;
        // $saveLog['user_name'] = $userName;
        $saveLog['login_at'] = date('Y-m-d H:i:s');
        $saveLog['os'] = !empty($deviceInfo['os']) ? $deviceInfo['os'] : '';
        $saveLog['device'] = !empty($deviceInfo['device']) ? $deviceInfo['device'] : '';
        $saveLog['login_city'] = !empty($ipLog['city']) ? $ipLog['city'] : '';
        $saveLog['login_state'] = !empty($ipLog['regionName']) ? $ipLog['regionName'] : '';
        $saveLog['login_country'] = !empty($ipLog['country']) ? $ipLog['country'] : '';
        $saveLog['login_ip'] = $ipAddress;
        $saveLog['add_date'] = date('Y-m-d H:i:s');
        $activity_id = $this->c_model->insertRecords('role_users_login_activity', $saveLog);
        $saveLog['activity_id'] = $activity_id;
        return $saveLog;
    }
    public function logout() {
        $loginData = $this->session->get('tutor_login_data');
        if (!empty($loginData['activity_id'])) {
            $activity_id = $loginData['activity_id'];
            $activityData = $this->c_model->getSingle('role_users_login_activity', '*', ['id' => $activity_id]);
            if (!empty($activityData)) {
                $login_at = $activityData['login_at'];
                $current_time = date('Y-m-d H:i:s');
                $from = strtotime($login_at);
                $to = strtotime($current_time);
                $difference = round(abs($to - $from) / 60);
                $activity = [];
                $activity['logout_at'] = date('Y-m-d H:i:s');
                $activity['session'] = $difference;
                $this->c_model->updateRecords('role_users_login_activity', $activity, ['id' => $activity_id]);
            }
        }
        $this->session->remove('tutor_login_data');
        return redirect()->to(base_url(TUTORPATH . "login"));
    }
    public function sendForgotPassword() {
        $email = !empty($this->request->getGet('email')) ? trim($this->request->getGet('email')) : "";
        $where = ["email" => $email];
        $select = "status";
        $tutor = $this->c_model->getSingle($this->table, $select, $where);
        if (empty($tutor)) {
            $response['status'] = false;
            $response['message'] = 'No Account Found With This Email';
            echo json_encode($response);
            exit;
        } else if (!empty($tutor) && ($tutor['status'] !== 'Active')) {
            $response['status'] = false;
            $response['message'] = 'Your Profile is currently Inactive';
            echo json_encode($response);
            exit;
        }
        $data = [];
        $password = generate_password(10);
        $data['enc_password'] = md5($password);
        $this->c_model->updateRecords('tutor_list', $data, ['email' => $email]);
        if (!empty($email)) {
            sendEmailForgotPassword($email, $password);
        }
        $response['status'] = true;
        $response['message'] = 'New Password Sent On Registered Email';
        echo json_encode($response);
        exit;
    }
}
