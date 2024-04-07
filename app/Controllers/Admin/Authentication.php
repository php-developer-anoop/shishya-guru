<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Authentication extends BaseController {
    protected $c_model;
    protected $session;
    protected $cookieName;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->cookieName = 'LoginStuck';
    }
    public function index() {
        $data["title"] = "Admin Panel";
        echo view("admin/login-form", $data);
    }
    public function checkLogin() {
        $post = $this->request->getVar();
        $response = [];
        $email = !empty($post["email"]) ? trim($post["email"]) : "";
        $password = !empty($post["password"]) ? trim($post["password"]) : "";
        if (empty($email) || empty($password)) {
            $response['status'] = false;
            $response['message'] = 'Please Enter Valid Email Address and Password';
            echo json_encode($response);
            exit;
        }
        $where = ["email" => $email, "enc_password" => md5($password) ];
        $select = "*";
        $user = $this->c_model->getSingle('admin', $select, $where);
        if (empty($user)) {
            $response['status'] = false;
            $response['message'] = 'Invalid Email or Password';
            echo json_encode($response);
            exit;
        }
        $sessionData = ['id' => $user['id'], 'name' => $user['username'], 'email' => $user['email'], 'is_logged_in' => true];
        $this->session->set('admin_login_data', $sessionData);
        $response['status'] = true;
        $response['goto'] = base_url(ADMINPATH . 'dashboard');
        $response['message'] = 'Logged in Successfully';
        echo json_encode($response);
        exit;
    }
    public function logout() {
        $session = $this->session;
        $session->destroy();
        return redirect()->to(base_url(ADMINPATH . "login"));
    }
}
?>
