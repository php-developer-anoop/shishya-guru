<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Generate_orderid extends BaseController {
    public $c_model;
    public function __construct() {
        $this->c_model = new Common_model();
    }
    public function index() {
      
        $response = [];
        $data = [];
        $post = pay_load();
        $user_id = !empty($post['user_id']) ? trim($post['user_id']) : '';
        $amount = !empty($post['amount']) ? trim($post['amount']) : '';
        $ref_id = !empty($post['ref_id']) ? trim($post['ref_id']) : '';
        $ref_for = !empty($post['ref_for']) ? trim($post['ref_for']) : '';
        $appType = !empty($post['app_type']) ? trim($post['app_type']) : 'app';
        if (!$user_id || !$amount) {
            $response['status'] = FALSE;
            $response['message'] = !$user_id ? 'User ID is blank!' : 'Amount is blank!';
            echo json_encode($response);
            exit;
        }
        $userData = $this->c_model->getSingle('tutor_list', '*', ['id' => $user_id]);
        if (!$userData) {
            $response['status'] = FALSE;
            $response['message'] = 'User data not found!';
            echo json_encode($response);
            exit;
        }
        $gstPercent = 0; //GST_PERCENT;
        $orderid = 'SG_' . date('Ymd') . rand(100, 999);
        $save = [];
        $check = [];
        $save['user_id'] = $user_id;
        $save['order_id'] = $orderid;
        $check = $save;
        $save['order_status'] = 'Created';
        $save['order_amount'] = $amount;
        $save['final_status'] = 'no';
        $save['created_at'] = date('Y-m-d H:i:s');
        $save['gst_percent'] = 0; // No need to check $gst_amount now, as it's commented out
        $save['gst_amount'] = 0; // As $gst_amount is commented out, assigning 0 directly
        $save['gateway_amount'] = 0; // Initialize to 0 for now
        $total_amount = (float)$amount + (float)$save['gst_amount'];
        $save['final_amount'] = (float)$total_amount + (float)$save['gateway_amount'];
        if (!empty($ref_for) && !empty($ref_id)) {
            $save['bank_txn_id'] = $ref_for;
            $save['reference_id'] = $ref_id;
        }
        $txn_data = $this->c_model->saveupdate('transaction_log', $save, $check);
        if (!$txn_data) {
            $response['status'] = FALSE;
            $response['message'] = 'Order ID already used!';
            echo json_encode($response);
            exit;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, INSTAMOZO_URL);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Api-Key:" . INSTAMOZO_API_KEY, "X-Auth-Token:" . INSTAMOZO_AUTH_TOKEN));
        $payload = array('purpose' => 'Refill Wallet', 'amount' => $amount, 'phone' => $userData['mobile_no'], 'buyer_name' => $userData['tutor_name'], 'redirect_url' => base_url(TUTORPATH . 'payment-success'), 'send_email' => true, 'webhook' => base_url(TUTORPATH . 'webhook'), 'send_sms' => true, 'email' => $userData['email'], 'allow_repeated_payments' => false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $apiresponse = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($apiresponse, true);
        // echo "<pre>";
        // print_r($result);exit;
        if ($err) {
            $response['status'] = FALSE;
            $response['message'] = $err;
        } else {
            $result = json_decode($apiresponse, true);
            $response['status'] = TRUE;
            $response['result'] = $result;
            //$response['data'] = ['orderid' => (string)$orderid, 'payment_session_id' => (string)(!empty($result["payment_session_id"]) ? $result["payment_session_id"] : '') ];
            $response['message'] = "Order Generated Successfully!";
        }
        echo json_encode($response);
        exit;
    }
}
