<?php
namespace App\Controllers;
use App\Models\Common_model;
class Ajax extends BaseController {
    public $c_model;
    public $session;
    public function __construct() {
        $this->c_model = new Common_model();
        $this->session = session();
    }
    public function index() {
        $city_id = !empty($this->request->getVar('city_id')) ? explode(',', $this->request->getVar('city_id')) : '';
        $city_name = !empty($this->request->getVar('city_name')) ? $this->request->getVar('city_name') : '';
        $no_area_found_img = base_url('assets/no_area_found.jpg');
        $areas = [];
        if (!empty($city_id)) {
            $city_name = getCityName($city_id[0]);
            $this->session->set('session_city', $city_name);
            $areas = $this->c_model->getAllData('area_list', 'id,area_name', ['city_id' => $city_id[0], 'state_id' => $city_id[1], 'status' => 'Active', 'is_popular' => 'Yes'], null, null, 'DESC', 'id');
        }
        if (!empty($city_name)) {
            $city = $this->c_model->getSingle('city_list', 'id,state_id', ['city_name' => $city_name]);
            $areas = $this->c_model->getAllData('area_list', 'id,area_name', ['city_id' => $city['id'], 'state_id' => $city['state_id'], 'status' => 'Active', 'is_popular' => 'Yes'], null, null, 'DESC', 'id');
        }
        if (!empty($areas)) {
            foreach ($areas as $akey => $avalue) {
                $active = $akey == 0 ? 'active' : '';
                $url = base_url('tutor-list?area=' . ($avalue['area_name']));
                echo '<div class="col-lg-4">
            <div class="header-box new_header">
              <a href="' . $url . '" class="' . $active . '">
                <span>
                  <p>' . $avalue['area_name'] . '</p>
                  <i class="fa-solid fa-chevron-right"></i>
                </span>
              </a>
            </div>
          </div>';
            }
        } else {
            echo "<div class='d-flex justify-content-center h-100'><img src=" . $no_area_found_img . " /></div>";
        }
    }
    public function getSubject() {
        $class_id = !empty($this->request->getPost('class_id')) ? $this->request->getPost('class_id') : '';
        if (!is_numeric($class_id)) {
            $c_id = getClassId($class_id);
        } else {
            $c_id = $class_id;
        }
        $subject_id = !empty($this->request->getPost('subject_id')) ? $this->request->getPost('subject_id') : '';
        $subjects = $this->c_model->getAllData('subject_list', 'id,subject_name', ['status' => 'Active', 'class_id' => $c_id]);
        $html = '<option value="">Select Option</option>';
        if (!empty($subjects)) {
            foreach ($subjects as $skey => $svalue) {
                $selected = !empty($subject_id) && ($subject_id == $svalue['id']) ? "selected" : "";
                $html.= '<option value="' . $svalue['id'] . '" ' . $selected . '>' . $svalue['subject_name'] . '</option>';
            }
        }
        echo $html;
    }
    public function getMultipleClassSubject() {
        $class_ids = $this->request->getPost('class_id');
        $subject_id = $this->request->getPost('subject_id');
        // echo "<pre>";
        // print_r( $subject_id);exit;
        if (!empty($class_ids) && is_array($class_ids)) {
            $class_id = implode(',', $class_ids);
            $query = "SELECT id, subject_name FROM dt_subject_list WHERE status = 'Active' AND class_id IN ($class_id)";
            $subjects = db()->query($query)->getResultArray();
            $html = '<option value="" disabled>Select Option</option>';
            if (!empty($subjects)) {
                foreach ($subjects as $skey => $svalue) {
                    $selected = !empty($subject_id) && in_array($svalue['id'], explode(',', $subject_id)) ? "selected" : "";
                    $html.= '<option value="' . $svalue['id'] . '" ' . $selected . '>' . $svalue['subject_name'] . '</option>';
                }
            }
            echo $html;
        }
    }
    public function getFees() {
        $class_id = !empty($this->request->getPost('class_id')) ? $this->request->getPost('class_id') : '';
        $city_id = !empty($this->request->getPost('city_id')) ? $this->request->getPost('city_id') : '';
        $state_id = !empty($this->request->getPost('city_id')) ? getStateId($this->request->getPost('city_id')) : '';
        $tuition_fee = !empty($this->request->getPost('tuition_fee')) ? $this->request->getPost('tuition_fee') : '';
        $html = '<option value="" disabled>Select Option</option>';
        if (!empty($state_id) && !empty($class_id) && is_array($class_id)) { // Corrected condition here
            $class = implode(',', $class_id);
            $feesList = db()->query("SELECT id, fee FROM dt_tuition_fee_list WHERE status = 'Active' AND state_id = $state_id AND class_id IN ($class)")->getResultArray();
            if (!empty($feesList)) {
                foreach ($feesList as $flkey => $flvalue) {
                    $selected = !empty($tuition_fee) && ($tuition_fee == $flvalue['fee']) ? "selected" : ""; // Corrected comparison operator here
                    $html.= '<option value="' . $flvalue['fee'] . '" ' . $selected . '>' . $flvalue['fee'] . '</option>';
                }
            }
            echo $html;
        }
    }
    function getRandomCaptcha() {
        $captua_token = random_alphanumeric_string(6);
        echo $captua_token;
    }
    function loadMoreTutors() {
        $page = !empty($this->request->getPost('page')) ? $this->request->getPost('page') : '';
        $limit = 10;
        $offset = ($page) * $limit;
        $where = [];
        $session_city = session()->get('session_city');
        if (!empty($session_city)) {
            $city_id = getCityIdFromName($session_city);
            $where['city'] = $city_id;
        }
        $where['status'] = 'Active';
        $where['kyc_status'] = 'Approved';
        $tutors = $this->c_model->getAllData('tutor_list', 'id,tutor_name,address,profile_image,city,experience_years,tutor_slug,gender,board,monthly_fees,subject,class,avg_rating,total_reviews', $where, $limit, $offset, 'DESC', 'id');
        //echo $this->c_model->getLastQuery();exit;
        if (!empty($tutors)) {
            foreach ($tutors as $tlkey => $tlvalue) {
                $totalBoards = 0;
                $totalSubjects = 0;
                $boards = !empty($tlvalue['board']) ? getMultipleBoard($tlvalue['board']) : '';
                $boardsArray = !empty($boards) ? explode(',', $boards) : [];
                $subject = !empty($tlvalue['subject']) ? getMultipleSubject($tlvalue['subject']) : '';
                $subjectArray = !empty($subject) ? explode(',', $subject) : [];
                $tutor_slug = !empty($tlvalue['tutor_slug']) ? base_url($tlvalue['tutor_slug']) : 'javascript:void(0)';
                $tutor_name = !empty($tlvalue['tutor_name']) ? $tlvalue['tutor_name'] : '';
                echo '<div class="cardbody-sec row mx-auto col-sm-6 col-lg-12 col-md-12">
                <div class="col-lg-3 col-md-3">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            <img src="' . (!empty($tlvalue['profile_image']) ? base_url('uploads/') . $tlvalue['profile_image'] : '') . '" class="img-fluid teachercard" alt="User Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="doc-info-cont">
                    <div class="dflexbtwn">
                    <h4 class="doc-name mx-2"><a href="' . $tutor_slug . '">' . $tutor_name . '</a></h4>
                    <div class="social-links d-flex justify-content-around">
                      <a href="https://www.facebook.com/sharer/sharer.php?u=' . $tutor_slug . '"><i class="bi bi-facebook"></i></a>
                      <a href="https://twitter.com/intent/tweet?url=' . $tutor_slug . '"><i class="bi bi-twitter"></i></a>
                      <a href="https://api.whatsapp.com/send?text=' . $tutor_slug . '"><i class="bi bi-whatsapp"></i></a>
                      <a href="https://www.linkedin.com/sharing/share-offsite/&amp;url=' . $tutor_slug . '"><i class="bi bi-linkedin"></i></a>
                    </div> 
                  </div>
                        
                        <div class="clinic-details">
                            <div class="col-lg-12 row mx-auto">
                                <div class="col-lg-5 col-md-5">
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/Book.png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['experience_years']) ? $tlvalue['experience_years'] . ' Years' : 'N/A') . '</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/Location.png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['address']) ? $tlvalue['address'] : 'N/A') . '</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/rupees.png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['monthly_fees']) ? (int)$tlvalue['monthly_fees'] . ' per month' : 'N/A') . '</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/profile (1).png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['gender']) ? $tlvalue['gender'] : 'N/A') . '</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="doc-info-right">
                                        <div class="clini-infos">
                                            <ul>
                                                <li><i class="fa-solid fa-star"></i>' . (!empty($tlvalue['avg_rating']) ? $tlvalue['avg_rating'] : 'N/A') . ' ' . (!empty($tlvalue['total_reviews']) ? '(' . $tlvalue['total_reviews'] . ' reviews)' : 'N/A') . ' </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="m-0">Listed In:</p>
                            <div class="col-lg-12 col-md-12 row p-0 m-0">
                                <div class="col-lg-9 col-md-5">
                                    <div class="clinic-services ">
                                        <span>' . (!empty($tlvalue['board']) ? getMultipleBoard($tlvalue['board']) : '') . '</span>
                                        <span>' . (!empty($tlvalue['subject']) ? getMultipleSubject($tlvalue['subject']) : '') . '</span>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-7">
                                    <div class="carddetailsbtn d-flex justify-content-end">
                                        <a href="' . $tutor_slug . '" class="details">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
        }
    }
    public function getReviews() {
        $val = !empty($this->request->getPost('val')) ? $this->request->getPost('val') : 'Latest';
        $tutor_id = !empty($this->request->getPost('tutor_id')) ? $this->request->getPost('tutor_id') : '';
        $page = !empty($this->request->getPost('page')) ? (int)$this->request->getPost('page') : 0;
        $limit = 10;
        $offset = $page * $limit;
        if ($val == "Latest" || $val == "Oldest") {
            $order = ($val == "Latest") ? "DESC" : "ASC";
            $where = [];
            $where['status'] = 'Active';
            if ($tutor_id != 0 && $tutor_id != "") {
                $where['tutor_id'] = $tutor_id;
            }
            $reviews = getData('dt_testimonial_list', '*', $where, $limit, $offset, 'id ' . $order);
            if (!empty($reviews)) {
                foreach ($reviews as $key => $value) {
                    $time = !empty($value['add_date']) ? date('H:i A', strtotime($value['add_date'])) : '';
                    $date = !empty($value['add_date']) ? date('d/m/Y', strtotime($value['add_date'])) : '';
                    echo '<div class="allreview-sec firstallreviwsec">
                    <span class="titlesec">
                        <h4>' . $value['name'] . '</h4>
                        <p>' . $value['location'] . '</p>
                    </span>
                    <p>' . $value['testimonial'] . '</p>
                    <div class="review-Icon">
                        ' . showRatings($value['rating']) . '
                        <p><b>Posted On:</b><span class="px-1">' . $date . '</span><span class="px-1">' . $time . '</span></p>
                    </div>
                    </div>';
                }
            }
        }
    }
    public function getSubjectClass() {
        $search_value = $this->request->getPost('search_value') ??'';
        $subjectData = db()->query('SELECT DISTINCT(subject_name) FROM dt_subject_list WHERE subject_name LIKE "%' . $search_value . '%"')->getResultArray();
        $classData = db()->query('SELECT class_name FROM dt_class_list WHERE class_name LIKE "%' . $search_value . '%"')->getResultArray();
        $html = '';
        if (!empty($subjectData) || !empty($classData)) {
            $html.= '<ul>';
            if (!empty($subjectData)) {
                foreach ($subjectData as $svalue) {
                    $url = base_url('tutor-list?subject_name=' . urlencode($svalue['subject_name']));
                    $html.= '<li class="text-white" onclick="gotoUrl(\'subject_name\',\'' . $svalue['subject_name'] . '\')" style="cursor:pointer">' . $svalue['subject_name'] . '</li>';
                }
            }
            if (!empty($classData)) {
                foreach ($classData as $cvalue) {
                    $url = base_url('tutor-list?class_name=' . urlencode($cvalue['class_name']));
                    $html.= '<li class="text-white" onclick="gotoUrl(\'class_name\', \'' . $cvalue['class_name'] . '\')" style="cursor:pointer">' . $cvalue['class_name'] . '</li>';
                }
            }
            $html.= '</ul>';
        }
        echo $html;
    }
    function getTutors() {
        $id = !empty($this->request->getPost('id')) ? $this->request->getPost('id') : '';
        $type = !empty($this->request->getPost('type')) ? $this->request->getPost('type') : '';
        $template_id = !empty($this->request->getPost('template_id')) ? $this->request->getPost('template_id') : '';
        $city_id = !empty($this->request->getPost('city_id')) ? $this->request->getPost('city_id') : '';
        $subject_id = !empty($this->request->getPost('subject_id')) ? $this->request->getPost('subject_id') : '';
        $template_type = !empty($this->request->getPost('template_type')) ? $this->request->getPost('template_type') : '';
        $where = [];
        $where['status'] = 'Active';
        $session_city = session()->get('session_city');
        if (!empty($session_city)) {
            $sess_city_id = getCityIdFromName($session_city);
            $where['city'] = $sess_city_id;
        }
        if (!empty($city_id)) {
            $where['city'] = $city_id;
        }
        if (!empty($subject_id)) {
            if (count(explode(',', $subject_id)) > 1) {
                $where['subject IN (' . $subject_id . ')'] = null;
            } else {
                $where['FIND_IN_SET("' . $subject_id . '", subject) >'] = 0;
            }
        }
        if ($template_type == "dt_boards_list") {
            $where['FIND_IN_SET("' . ($template_id) . '", board) >'] = 0;
        } else if ($template_type == "dt_class_list") {
            $where['FIND_IN_SET("' . ($template_id) . '", class) >'] = 0;
        } else if ($template_type == "dt_subject_list") {
            $where['FIND_IN_SET("' . ($template_id) . '", subject) >'] = 0;
        }
        if ($type == 'class') {
            $where['FIND_IN_SET("' . $id . '", class) >'] = 0;
        } else if ($type == 'area') {
            $where['address LIKE'] = '%' . ($id) . '%';
        } else if ($type == 'board') {
            $where['FIND_IN_SET("' . $id . '", board) >'] = 0;
        }
        $tutors = $this->c_model->getAllData('tutor_list', 'id,tutor_name,address,profile_image,city,experience_years,tutor_slug,gender,board,monthly_fees,subject,class,avg_rating,total_reviews', $where, null, null, 'DESC', 'id');
        $no_tutor_found_img = base_url('assets/no_tutor_found.jpg');
        if (!empty($tutors)) {
            foreach ($tutors as $tlkey => $tlvalue) {
                $boards = !empty($tlvalue['board']) ? getMultipleBoard($tlvalue['board']) : '';
                $boardsArray = !empty($boards) ? explode(',', $boards) : [];
                $subject = !empty($tlvalue['subject']) ? getMultipleSubject($tlvalue['subject']) : '';
                $subjectArray = !empty($subject) ? explode(',', $subject) : [];
                $tutor_slug = !empty($tlvalue['tutor_slug']) ? base_url($tlvalue['tutor_slug']) : 'javascript:void(0)';
                $tutor_name = !empty($tlvalue['tutor_name']) ? $tlvalue['tutor_name'] : '';
                echo '<div class="cardbody-sec row mx-auto col-sm-6 col-lg-12 col-md-12">
                <div class="col-lg-3 col-md-3">
                    <div class="doc-info-left">
                        <div class="doctor-img">
                            <img src="' . (!empty($tlvalue['profile_image']) ? base_url('uploads/') . $tlvalue['profile_image'] : '') . '" class="img-fluid teachercard" alt="User Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="doc-info-cont">
                        <div class="dflexbtwn">
                    <h4 class="doc-name mx-2"><a href="' . $tutor_slug . '">' . $tutor_name . '</a></h4>
                    <div class="social-links d-flex justify-content-around">
                      <a href="https://www.facebook.com/sharer/sharer.php?u=' . $tutor_slug . '"><i class="bi bi-facebook"></i></a>
                      <a href="https://twitter.com/intent/tweet?url=' . $tutor_slug . '"><i class="bi bi-twitter"></i></a>
                      <a href="https://api.whatsapp.com/send?text=' . $tutor_slug . '"><i class="bi bi-whatsapp"></i></a>
                      <a href="https://www.linkedin.com/sharing/share-offsite/&amp;url=' . $tutor_slug . '"><i class="bi bi-linkedin"></i></a>
                    </div> 
                  </div>
                        <div class="clinic-details">
                            <div class="col-lg-12 row mx-auto">
                                <div class="col-lg-5 col-md-5">
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/Book.png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['experience_years']) ? $tlvalue['experience_years'] . ' Years' : 'N/A') . '</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/Location.png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['address']) ? $tlvalue['address'] : 'N/A') . '</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/rupees.png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['monthly_fees']) ? (int)$tlvalue['monthly_fees'] . ' per month' : 'N/A') . '</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex appoitnment-img">
                                            <img src="' . base_url('assets/frontend/') . 'img/profile (1).png" class="img-fluid"> 
                                            <p class="doc-location">' . (!empty($tlvalue['gender']) ? $tlvalue['gender'] : 'N/A') . '</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3">
                                    <div class="doc-info-right">
                                        <div class="clini-infos">
                                            <ul>
                                                <li><i class="fa-solid fa-star"></i> ' . (!empty($tlvalue['avg_rating']) ? $tlvalue['avg_rating'] : 'N/A') . ' ' . (!empty($tlvalue['total_reviews']) ? '(' . $tlvalue['total_reviews'] . ' reviews)' : 'N/A') . ' </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="m-0">Listed In:</p>
                            <div class="col-lg-12 col-md-12 row p-0 m-0">
                                <div class="col-lg-9 col-md-5">
                                    <div class="clinic-services ">';
                if (!empty($boardsArray)) {
                    foreach ($boardsArray as $bavalue) {
                        echo '<span>' . $bavalue . '</span>';
                    }
                }
                if (!empty($subjectArray)) {
                    foreach ($subjectArray as $savalue) {
                        echo '<span>' . $savalue . '</span>';
                    }
                }
                echo '</div>
                                </div>
                                <div class="col-lg-3 col-md-7">
                                    <div class="carddetailsbtn d-flex justify-content-end">
                                        <a href="' . $tutor_slug . '" class="details">View Details</a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
        } else {
            echo "<div class='d-flex justify-content-center mt-1 h-100 mb-3'><img src=" . $no_tutor_found_img . " /></div>";
        }
    }
    public function getLocation() {
        $keyword = !empty($this->request->getPost('keyword')) ? $this->request->getPost('keyword') : '';
        $query = 'SELECT city_name FROM dt_city_list WHERE status = "Active" AND (city_name LIKE "%' . $keyword . '%") ';
        $data = db()->query($query)->getResultArray();
        $html = '';
        if (!empty($data)) {
            $html.= '<ul class=" d-flex flex-column h-100 position-relative z-1 ps-0">';
            foreach ($data as $svalue) {
                $location = $svalue['city_name'];
                $escaped_location = htmlspecialchars($location, ENT_QUOTES, 'UTF-8');
                $html.= '<li class="fs-14 fw-normal text-white" onclick="gotoLocation(\'' . $escaped_location . '\')" style="cursor:pointer">' . $location . '</li>';
            }
            $html.= '</ul>';
        } else {
            $html = '<ul class=" d-flex flex-column h-100 position-relative z-1 ps-0"><li class="text-white">No Record Found</li></ul>';
        }
        echo $html;
    }
    public function saveQuery() {
        $post = $this->request->getPost();
        $response = [];
        $data['name'] = !empty($post['name']) ? testInput(trim($post['name'])) : '';
        $data['email'] = !empty($post['email']) ? testInput(trim($post['email'])) : '';
        $data['subject'] = !empty($post['subject']) ? testInput(trim($post['subject'])) : '';
        $data['message'] = !empty($post['message']) ? testInput(trim($post['message'])) : '';
        $data['add_date'] = date('Y-m-d H:i:s');
        $last_id = $this->c_model->insertRecords('enquiry_list', $data);
        if ($last_id) {
            $response['status'] = true;
            $response['message'] = 'Query Submitted Successfully';
            echo json_encode($response);
            exit;
        } else {
            $response['status'] = false;
            $response['message'] = 'Something Went Wrong';
            echo json_encode($response);
            exit;
        }
    }
    public function getCity() {
        $keyword = !empty($this->request->getPost('keyword')) ? $this->request->getPost('keyword') : '';
        $query = 'SELECT city_name FROM dt_city_list WHERE status = "Active" AND (city_name LIKE "%' . $keyword . '%") ';
        $data = db()->query($query)->getResultArray();
        $html = '';
        if (!empty($data)) {
            $html.= '<ul class="d-flex flex-column h-100 position-relative z-1 ps-0">';
            foreach ($data as $svalue) {
                $location = $svalue['city_name'];
                $escaped_location = htmlspecialchars($location, ENT_QUOTES, 'UTF-8');
                $html.= '<li onclick="return gotoCity(\'' . $escaped_location . '\',\'' . $location . '\')" style="cursor:pointer" class="fs-14 fw-normal text-white">' . $location . '</li>';
            }
            $html.= '</ul>';
        } else {
            $html = '<ul class="d-flex flex-column h-100 position-relative z-1 ps-0"><li class="text-white">No Record Found</li></ul>';
        }
        echo $html;
    }
    public function setCity() {
        $city = !empty($this->request->getPost('city')) ? $this->request->getPost('city') : '';
        $this->session->set('session_city', $city);
    }
    public function checkSessionSetCity() {
        $check = $this->session->get('session_city');
        if (!empty($check)) {
            echo "true";
        } else {
            echo "false";
        }
    }
}
