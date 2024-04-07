<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Ajax extends BaseController {
    protected $c_model;
    protected $session;
    public function __construct() {
        $this->c_model = new Common_model();
        $this->session = session();
    }
    public function index() {
        $id = $this->request->getVar("id") ??"";
        $table = $this->request->getVar("table") ??"";
        if (!empty($id) && !empty($table)) {
            $records = $this->c_model->getSingle($table, 'status', ['id' => $id]);
            if (!empty($records)) {
                $current_status = $records['status'];
                $new_status = ($current_status == "Active") ? "Inactive" : "Active";
                $this->c_model->updateRecords($table, ['status' => $new_status], ['id' => $id]);
                if ($table == "dt_testimonial_list") {
                    $records = $this->c_model->getSingle($table, 'tutor_id,status', ['id' => $id]);
                    if (!empty($records) && $records['status'] == "Active") {
                        $tutor_id = $records['tutor_id'];
                        $tutor_rating = $this->c_model->getSingle($table, 'AVG(rating) as avg_rating, COUNT(id) as total', ['tutor_id' => $tutor_id, 'status' => 'Active']);
                        $this->c_model->updateRecords('tutor_list', ['avg_rating' => $tutor_rating['avg_rating'], 'total_reviews' => $tutor_rating['total']], ['id' => $tutor_id]);
                    }
                }
                echo $new_status;
            }
        }
    }
    public function changePopular() {
        $id = !empty($this->request->getVar("id")) ? $this->request->getVar("id") : "";
        $table = !empty($this->request->getVar("table")) ? $this->request->getVar("table") : "";
        $records = $this->c_model->getSingle($table, 'is_popular', ['id' => $id]);
        if (!empty($records)) {
            $current_status = $records['is_popular'];
            if ($current_status == "Yes") {
                $data['is_popular'] = "No";
            } else {
                $data['is_popular'] = "Yes";
            }
            $this->c_model->updateRecords($table, $data, ['id' => $id]);
            echo $data['is_popular'];
        }
    }
    public function delCity() {
        $id = $this->request->getVar("id") ??"";
        $records = $this->c_model->getSingle('city_list', null, ['id' => $id]);
        if (!empty($records)) {
            $this->c_model->deleteRecords('city_list', ['id' => $id]);
        }
    }
    public function delArea() {
        $id = $this->request->getVar("id") ??"";
        $records = $this->c_model->getSingle('area_list', null, ['id' => $id]);
        if (!empty($records)) {
            $this->c_model->deleteRecords('area_list', ['id' => $id]);
        }
    }
    public function delFaq() {
        $id = $this->request->getVar("id") ??"";
        $records = $this->c_model->getSingle('faq_master', null, ['id' => $id]);
        if (!empty($records)) {
            $this->c_model->deleteRecords('faq_master', ['id' => $id]);
        }
    }
    public function delFees() {
        $id = $this->request->getVar("id") ??"";
        $records = $this->c_model->getSingle('tuition_fee_list', null, ['id' => $id]);
        if (!empty($records)) {
            $this->c_model->deleteRecords('tuition_fee_list', ['id' => $id]);
        }
    }
    public function getCount() {
        $type = $this->request->getVar('type') ??"";
        $table = $this->request->getVar('table') ??"";
        //echo $type.' '.$table;exit; 
        $where = [];
        if (in_array($type, ['new', 'assigned', 'all', 'pending'])) {
            if ($type !== "all") {
                if ($type == "pending") {
                    $where['lead_status'] = 'Accepted';
                } else {
                    $where['lead_status'] = ucfirst($type);
                }
            }
        }
        if (in_array($type, ['all_tutors', 'kyc_pending_tutors', 'kyc_completed_tutors'])) {
            if ($type !== "all_tutors") {
                if ($type == "kyc_pending_tutors") {
                    $where['kyc_status'] = 'Pending';
                } else {
                    $where['kyc_status'] = 'Approved';
                }
            }
        }
        if($type=="pending_recharge_request"){
            $where['status'] = 'Pending';
        }
        if ($table != "leads_list" && $table != "recharge_request" ) {
            $where['status'] = 'Active';
        }
        $count = count_data('id', $table, $where);
        echo $count;
    }
    public function getSlug() {
        $keyword = $this->request->getVar("keyword");
        if (empty($keyword)) {
            return '';
        }
        $slug = validate_slug($keyword);
        return $slug;
    }
    public function getCities() {
        $state_id = !empty($this->request->getVar('state_id')) ? $this->request->getVar('state_id') : '';
        $city_id = !empty($this->request->getVar('city_id')) ? explode(',', $this->request->getVar('city_id')) : '';
        $cities = $this->c_model->getAllData('city_list', 'id,city_name', ['status' => 'Active', 'state_id' => $state_id]);
        $html = '<option value="">Select City</option>';
        if (!empty($cities)) {
            foreach ($cities as $key => $value) {
                $selected = !empty($city_id) && (in_array($value['id'], $city_id)) ? "selected" : "";
                $html.= '<option ' . $selected . ' value="' . $value['id'] . '" >' . $value['city_name'] . '</option>';
            }
        }
        echo $html;
    }
    public function changeKycStatus() {
        $post = $this->request->getPost();
        $tutor_id = isset($post['tutor_id']) ? $post['tutor_id'] : '';
        $kyc_status = isset($post['kyc_status']) ? $post['kyc_status'] : '';
        $response = [];
        if (!empty($tutor_id) && !empty($kyc_status)) {
            $data = [];
            $data['kyc_status'] = $kyc_status;
            if ($kyc_status == "Approved") {
                $data['form_step'] = '';
            }
            $updated = $this->c_model->updateRecords('dt_tutor_list', $data, ['id' => $tutor_id]);
            if ($updated) {
                $response['status'] = true;
                $response['kyc_status'] = $kyc_status;
                $response['message'] = 'KYC Status Changed';
            } else {
                $response['status'] = false;
                $response['message'] = 'Failed to update KYC Status';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'Invalid tutor ID or KYC status';
        }
        echo json_encode($response);
        exit;
    }
    public function getTypeList() {
        $type = !empty($this->request->getPost('type')) ? $this->request->getPost('type') : '';
        $html = '<option value="" disabled>Choose Option</option>';
        if (!empty($type)) {
            if ($type == "dt_boards_list") {
                $data = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active', 'is_seo_added' => 'Yes']);
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $html.= '<option value="' . $value['id'] . '">' . $value['board_name'] . '</option>';
                    }
                }
            } elseif ($type == "dt_class_list") {
                $data = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active', 'is_seo_added' => 'Yes']);
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $html.= '<option value="' . $value['id'] . '">' . $value['class_name'] . '</option>';
                    }
                }
            } elseif ($type == "dt_subject_list") {
                $data = $this->c_model->getAllData('subject_list', 'id,subject_name', ['status' => 'Active', 'is_seo_added' => 'Yes']);
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $html.= '<option value="' . $value['id'] . '">' . $value['subject_name'] . '</option>';
                    }
                }
            }
        }
        return $html;
    }
    public function getList() {
        $id = $this->request->getPost('id');
        $type = $this->request->getPost('type');
        if (!empty($type) && !empty($id)) {
            if ($type == "State") {
                $data = $this->c_model->getAllData('city_list', 'id,city_name', ['status' => 'Active', 'state_id' => $id]);
                if (!empty($data)) {
                    $html = '<table id="responseData" class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>City Name</th>
                                        <th>Select All <input type="checkbox" id="selectAllCity"  class="read"> </th>
                                    </tr>
                                </thead>
                                <tbody>';
                    foreach ($data as $key => $value) {
                        $html.= '<tr>
                                    <td>' . $value['id'] . '</td>
                                    <td>' . $value['city_name'] . '</td>
                                    <td><input type="checkbox" name="cities[]" value="' . $value['city_name'] . ',' . $value['id'] . '" class="city-checkbox">
                                    </td>
                                </tr>';
                    }
                    $html.= '</tbody>
                            </table>';
                    $html.= '<script>
                                $(document).ready(function() {
                                    $("#selectAllCity").click(function() {
                                        var checkboxes = $(".city-checkbox");
                                        if ($(this).prop("checked")) {
                                            checkboxes.prop("checked", true);
                                        } else {
                                            checkboxes.prop("checked", false);
                                        }
                                        updateSelectedValues();
                                    });
        
                                    $(".city-checkbox").click(function() {
                                        updateSelectedValues();
                                    });
        
                                    function updateSelectedValues() {
                                        var selectedValues = [];
                                        $(".city-checkbox:checked").each(function() {
                                            selectedValues.push($(this).val());
                                        });
                                        selectedValues.join(",");
                                    }
                                });
                            </script>';
                    return $html;
                }
            }
            if ($type == "City") {
                $data = $this->c_model->getAllData('area_list', 'id,area_name', ['status' => 'Active', 'city_id' => $id]);
                if (!empty($data)) {
                    $html = '<table id="responseData" class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Area Name</th>
                                        <th>Select All <input type="checkbox"  id="selectAllArea"></th>
                                    </tr>
                                </thead>
                                <tbody>';
                    foreach ($data as $key => $value) {
                        $html.= '<tr>
                                    <td>' . $value['id'] . '</td>
                                    <td>' . $value['area_name'] . '</td>
                                    <td><input type="checkbox"  name="areas[]" value="' . $value['area_name'] . ',' . $value['id'] . '" class="area-checkbox">
                                    </td>
                                 </tr>';
                    }
                    $html.= '</tbody>
                            </table>';
                    $html.= '<script>
                            $(document).ready(function() {
                                $("#selectAllArea").click(function() {
                                    var checkboxes = $(".area-checkbox");
                                    if ($(this).prop("checked")) {
                                        checkboxes.prop("checked", true);
                                    } else {
                                        checkboxes.prop("checked", false);
                                    }
                                    updateSelectedValues();
                                });
    
                                $(".area-checkbox").click(function() {
                                    updateSelectedValues();
                                });
    
                                function updateSelectedValues() {
                                    var selectedValues = [];
                                    $(".area-checkbox:checked").each(function() {
                                        selectedValues.push($(this).val());
                                    });
                                    selectedValues.join(",");
                                }
                            });
                        </script>';
                    return $html;
                }
            }
        }
        return '';
    }
    public function deleteRecord() {
        $id = $this->request->getVar("id") ??"";
        $table = $this->request->getVar("table") ??"";
        $records = $this->c_model->getSingle($table, null, ['id' => $id]);
        if (!empty($records)) {
            $status = $this->c_model->deleteRecords($table, ['id' => $id]);
        }
        return $status;
    }
    public function refillWallet() {
        $amount = $this->request->getPost('amount') ??'';
        $credit_debit = $this->request->getPost('credit_debit') ??'';
        $remark = $this->request->getPost('remark') ??'';
        $tutor_id = $this->request->getPost('tutor_id') ??'';
        $amount = filter_var($amount, FILTER_VALIDATE_FLOAT);
        $tutor_id = filter_var($tutor_id, FILTER_VALIDATE_INT);
        if ($amount === false || $tutor_id === false) {
            $response['status'] = false;
            $response['message'] = 'Invalid amount or tutor ID';
            echo json_encode($response);
            exit;
        }
        $balance = $this->c_model->getSingle('tutor_list', 'wallet_balance', ['id' => $tutor_id]);
        if (!$balance) {
            $response['status'] = false;
            $response['message'] = 'Tutor not found';
            echo json_encode($response);
            exit;
        }
        if ($credit_debit == "Debit") {
            if ($amount > $balance['wallet_balance']) {
                $response['status'] = false;
                $response['message'] = 'Insufficient Balance To Debit';
                echo json_encode($response);
                exit;
            }
            $message = "Amount Debited Successfully";
            $final_amount = $balance['wallet_balance'] - $amount;
        } else if ($credit_debit == "Credit") {
            $message = "Amount Credited Successfully";
            $final_amount = $balance['wallet_balance'] + $amount;
        }
        $txn_id = 'SG_' . rand(000000000, 999999999);
        $data = ['credit_debit' => lcfirst($credit_debit), 'user_id' => $tutor_id, 'transaction_id' => $txn_id, 'before_amount' => $balance['wallet_balance'], 'txn_amount' => $amount, 'final_amount' => $final_amount, 'created_date' => date('Y-m-d H:i:s'), 'remark' => $remark];
        $last_id = $this->c_model->insertRecords('wallet', $data);
        if ($last_id) {
            $this->c_model->updateRecords('tutor_list', ['wallet_balance' => $final_amount], ['id' => $tutor_id]);
            $response['status'] = true;
            $response['message'] = $message;
            echo json_encode($response);
            exit;
        } else {
            $response['status'] = false;
            $response['message'] = 'Something went wrong';
            echo json_encode($response);
            exit;
        }
    }
    public function cancelLead() {
        $lead_id = $this->request->getPost('lead_id') ??'';
        $response = [];
        if (empty($lead_id)) {
            $response['status'] = false;
            $response['message'] = 'Lead id is blank';
            echo json_encode($response);
            exit;
        }
        $check = getSingle('leads_list', 'lead_status', ['id' => $lead_id]);
        if ($check && $check['lead_status'] == "Cancelled") {
            $response['status'] = false;
            $response['message'] = 'Lead is already cancelled';
            echo json_encode($response);
            exit;
        }
        $this->c_model->updateRecords('leads_list', ['lead_status' => 'Cancelled'], ['id' => $lead_id]);
        $response['status'] = true;
        $response['message'] = 'Lead Cancelled Successfully';
        $response['lead_status'] = 'Cancelled';
        echo json_encode($response);
        exit;
    }
    public function getAcceptedTutors() {
        $leadId = $this->request->getPost('lead_id') ??'';
        // Sanitize lead ID
        $leadId = filter_var($leadId, FILTER_SANITIZE_NUMBER_INT);
        if (!empty($leadId)) {
            $acceptedBy = getSingle('leads_list', 'accepted_by,assigned_tutor_id', ['id' => $leadId]);
            if (!empty($acceptedBy['accepted_by'])) {
                $acceptedTutorsIds = explode(',', $acceptedBy['accepted_by']);
                // $acceptedTutorsIds = array_map('intval', $acceptedTutorsIds); // Sanitize IDs as integers
                // Prepare the SQL statement using prepared statements to prevent SQL injection
                $placeholders = implode(',', $acceptedTutorsIds);
                $sql = 'SELECT tutor_name, id,unique_id, mobile_no FROM dt_tutor_list WHERE id IN (' . $placeholders . ')';
                // Fetch tutors from the database
                $tutors = db()->query($sql, $acceptedTutorsIds)->getResultArray();
                if (!empty($tutors)) {
                    foreach ($tutors as $tutor) {
                        $checked = $acceptedBy['assigned_tutor_id'] == $tutor['id'] ? "checked" : "";
                        // Escape HTML attributes to prevent XSS attacks
                        $tutorName = htmlspecialchars($tutor['tutor_name']);
                        $mobileNo = htmlspecialchars($tutor['mobile_no']);
                        $id = htmlspecialchars($tutor['id']);
                        $unique_id = htmlspecialchars($tutor['unique_id']);
                        // Output radio button with tutor details
                        echo "<div class='col-lg-12'><input type='radio' name='tutor' id='tutor' $checked data-mobile='$mobileNo' data-tutor_name='$tutorName' class='mx-2' value='$id'>" . $tutorName . '/' . $unique_id . '/' . $mobileNo . "</div>";
                    }
                } else {
                    echo "No accepted tutors found.";
                }
            } else {
                echo "No accepted tutors found.";
            }
        } else {
            echo "Invalid lead ID.";
        }
    }
    public function assignTutor() {
        $post = $this->request->getPost();
        $tutor_id = !empty($post['tutor_id']) ? $post['tutor_id'] : '';
        $name = !empty($post['name']) ? $post['name'] : '';
        $mobile_no = !empty($post['mobile_no']) ? $post['mobile_no'] : '';
        $lead_id = !empty($post['lead_id']) ? $post['lead_id'] : '';
        $response = [];
        if (empty($tutor_id)) {
            $response['status'] = false;
            $response['message'] = 'Tutor id is blank';
            echo json_encode($response);
            exit;
        }
        if (empty($name)) {
            $response['status'] = false;
            $response['message'] = 'Tutor name is blank';
            echo json_encode($response);
            exit;
        }
        if (empty($mobile_no)) {
            $response['status'] = false;
            $response['message'] = 'Tutor mobile is blank';
            echo json_encode($response);
            exit;
        }
        if (empty($lead_id)) {
            $response['status'] = false;
            $response['message'] = 'Lead id is blank';
            echo json_encode($response);
            exit;
        }
        $saveData = [];
        $saveData['assigned_tutor_id'] = $tutor_id;
        $saveData['assigned_tutor_name'] = $name;
        $saveData['assigned_tutor_mobile_no'] = $mobile_no;
        $saveData['assigned_date_time'] = date('Y-m-d H:i:s');
        $saveData['lead_status'] = 'Assigned';
        $this->c_model->updateRecords('leads_list', $saveData, ['id' => $lead_id]);
        $response['status'] = true;
        $response['lead_status'] = 'Assigned';
        $response['message'] = 'Lead Assigned Successfully To Tutor ' . $name;
        echo json_encode($response);
        exit;
    }
    public function appendDetails() {
        $post = $this->request->getPost();
        $schedule_name = !empty($post['schedule_name']) ? $post['schedule_name'] : '';
        $description = !empty($post['description']) ? $post['description'] : '';
        $lead_id = !empty($post['lead_id']) ? $post['lead_id'] : '';
        $student_name = !empty($post['student_name']) ? $post['student_name'] : '';
        $student_mobile_no = !empty($post['student_mobile_no']) ? $post['student_mobile_no'] : '';
        $student_email = !empty($post['student_email']) ? $post['student_email'] : '';
        $schedule_date_time = !empty($post['schedule_date_time']) ? $post['schedule_date_time'] : '';
        echo '<div class="row">
                <div class="col-lg-12"><b>Schedule Name  : </b>' . $schedule_name . '</div>
                <div class="col-lg-12"><b>Lead Id  : </b>' . $lead_id . '</div>
                <div class="col-lg-12"><b>Student Name  : </b>' . $student_name . '</div>
                <div class="col-lg-12"><b>Student Mobile  : </b>' . $student_mobile_no . '</div>
                <div class="col-lg-12"><b>Student Email  : </b>' . $student_email . '</div>
                <div class="col-lg-12"><b>Scheduled On  : </b>' . $schedule_date_time . '</div>
                <div class="col-lg-12"><b>Description  : </b>' . $description . '</div>
              </div>';
    }
    public function changeRechargeStatus() {
        $post = $this->request->getPost();
        $id = isset($post['id']) ? $post['id'] : '';
        $tutor_id = isset($post['tutor_id']) ? $post['tutor_id'] : '';
        $txn_id = isset($post['txn_id']) ? $post['txn_id'] : '';
        $amount = isset($post['amount']) ? $post['amount'] : '';
        $status = isset($post['status']) ? $post['status'] : '';
        $response = [];
        if (!empty($id) && !empty($status)) {
            $data = [];
            $data['status'] = $status;
            if($status=="Approved"){
                $wallet=$this->c_model->getSingle('tutor_list','wallet_balance',['id'=>$tutor_id]);
                $saveWallet=[];
                $saveWallet['credit_debit']='credit';
                $saveWallet['user_id']=$tutor_id;
                $saveWallet['before_amount']=$wallet['wallet_balance'];
                $saveWallet['txn_amount']=$amount;
                $saveWallet['final_amount']=$amount+$wallet['wallet_balance'];
                $saveWallet['transaction_id']=$txn_id;
                $saveWallet['created_date']=date('Y-m-d H:i:s'); 
                $saveWallet['remark']='Refill Wallet With Amount = '.$amount;
                $wallet_id=$this->c_model->insertRecords('wallet',$saveWallet);
                $this->c_model->updateRecords('tutor_list',['wallet_balance'=>$saveWallet['final_amount']], ['id' => $tutor_id]);
            }
            $data['update_date'] = date('Y-m-d H:i:s');
            $updated = $this->c_model->updateRecords('dt_recharge_request', $data, ['id' => $id]);
            if ($updated) {
                $response['status'] = true;
                $response['status'] = $status;
                $response['message'] = 'Status Changed';
                echo json_encode($response);
                exit;
            } else {
                $response['status'] = false;
                $response['message'] = 'Failed to update Status';
                echo json_encode($response);
                exit;
            }
        }
    }
}
