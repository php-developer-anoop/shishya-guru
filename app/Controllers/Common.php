<?php
namespace App\Controllers;
use App\Models\Common_model;
class Common extends BaseController {
    public $c_model;
    public $session;
    public function __construct() {
        $this->c_model = new Common_model();
        $this->session = session();
    }
    public function index() {
        $uri = service('uri');
        $url = $uri->setSilent()->getSegment(1);
        $tutor_url = '';
        $tutor_url.= ($uri->getSegment(1)) ? $uri->getSegment(1) : '';
        $tutor_url.= ($uri->getSegment(2)) ? '/' . $uri->getSegment(2) : '';
        $tutor_url.= ($uri->getSegment(3)) ? '/' . $uri->getSegment(3) : '';
        $tutor_url.= ($uri->getSegment(4)) ? '/' . $uri->getSegment(4) : '';
        $tutor = $this->c_model->getSingle('tutor_list', '*', ['tutor_slug' => $tutor_url, 'status' => 'Active']);
        $cms = $this->c_model->getSingle('cms_list', '*', ['slug' => $url, 'status' => 'Active']);
        $blogDetails = $this->c_model->getSingle('blogs_list', '*', ['slug' => $url, 'status' => 'Active']);
        $seoDetails = $this->c_model->getSingle('city_area_seo_pages', '*', ['slug' => $url, 'status' => 'Active']);
        
        if ($cms) {
            $this->LoadCmsPage($cms, $url);
        } else if ($blogDetails) {
            $this->LoadBlogsDetails($blogDetails);
        } else if ($tutor) {
            $this->LoadTutorDetails($tutor);
        } else if ($seoDetails) {
            $this->LoadSeoDetails($seoDetails, $url);
        }
    }
    public function LoadCmsPage($cms, $url) {
        if ($url == 'about-us') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') .($cms['banner_image_jpg']) : base_url('uploads/') .($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            frontView('about-us', $data);
        }
        if ($url == 'contact-us') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') .($cms['banner_image_jpg']) : base_url('uploads/') .($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            frontView('contact', $data);
        }
        if ($url == 'privacy-policy') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') .($cms['banner_image_jpg']) : base_url('uploads/') .($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            frontView('privacy-policy', $data);
        }
        if ($url == 'faqs') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') .($cms['banner_image_jpg']) : base_url('uploads/') . ($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            $data['faq_list'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['status' => 'Active'], null, null, 'DESC', 'id', 'question');
            frontView('faq', $data);
        }
        if ($url == 'terms-and-conditions') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') . ($cms['banner_image_jpg']) : base_url('uploads/') . ($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            frontView('terms-conditions', $data);
        }
        if ($url == 'blogs') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') . ($cms['banner_image_jpg']) : base_url('uploads/') . ($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            $data['testimonial_list'] = $this->c_model->getAllData('testimonial_list', '*', ['status' => 'Active'], 2);
            $blogs = $this->c_model->getAllData('blogs_list', 'id,blog_title,short_description,created_date,created_by,blog_image_jpg,blog_image_webp,blog_image_alt,slug', ['status' => 'Active'], 10, null);
            //echo $this->c_model->getLastQuery();exit;
            $firstArray = [];
            $secondArray = [];
            $count = 0;
            foreach ($blogs as $blog) {
                if ($count < 4) {
                    $firstArray[] = $blog;
                } else {
                    $secondArray[] = $blog;
                }
                $count++;
            }
            $data['upper_blogs'] = $firstArray;
            $data['lower_blogs'] = $secondArray;
            frontView('blog-listing', $data);
        }
        if ($url == 'tutor-register') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') . ($cms['banner_image_jpg']) : base_url('uploads/') . ($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            $data['faq_list'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['status' => 'Active', 'table_id' => $cms['id'], 'table_name' => 'dt_cms_list']);
            $data['testimonial_list'] = $this->c_model->getAllData('testimonial_list', '*', ['status' => 'Active'], 2);
            $table = 'dt_city_list as a';
            $joinArray[0]['table'] = 'dt_state_list as b';
            $joinArray[0]['join_on'] = 'a.state_id = b.id';
            $joinArray[0]['join_type'] = 'INNER';
            $data['city_list'] = $this->c_model->getAllData($table, 'a.id,a.state_id,a.city_name,b.state_name', ['a.status' => 'Active'], null, null, null, null, null, $joinArray);
            $data['board_list'] = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active']);
            $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active']);
            frontView('become-tutor', $data);
        }
        if ($url == 'reviews') {
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') . ($cms['banner_image_jpg']) : base_url('uploads/') . ($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            $data['faq_list'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['status' => 'Active', 'table_id' => $cms['id'], 'table_name' => 'dt_cms_list']);
            $where=[];
            $where['status']='Active';
            $data['tutor_id']=!empty($this->request->getGet('tutor_id'))?$this->request->getGet('tutor_id'):'';
            if(!empty($data['tutor_id'])){
                 $where['tutor_id']=$data['tutor_id'];
            }
           
            $data['testimonial_list'] = $this->c_model->getAllData('testimonial_list', '*', $where, 10, null, 'DESC', 'id');
            frontView('rating-review', $data);
        }
        if ($url == 'tutor-list') {
            $get = $this->request->getGet();
            $data = [];
            $company = webSetting('*');
            $session_city = session()->get('session_city');
            $data['location'] = !empty($session_city) ? $session_city : '';
            $data['og_image'] = !empty($cms['banner_image_jpg']) ? base_url('uploads/') . ($cms['banner_image_jpg']) : base_url('uploads/') . ($company['logo_jpg']);
            $data['meta_title'] = !empty($cms['meta_title']) ? $cms['meta_title'] : '';
            $data['meta_description'] = !empty($cms['meta_description']) ? $cms['meta_description'] : '';
            $data['meta_keyword'] = !empty($cms['meta_keyword']) ? $cms['meta_keyword'] : '';
            $data['page'] = $cms;
            $data['page_url'] = base_url($url);
            $data['faq_list'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['status' => 'Active', 'table_id' => $cms['id'], 'table_name' => 'dt_cms_list']);
            $data['testimonial_list'] = $this->c_model->getAllData('testimonial_list', '*', ['status' => 'Active'], 2);
            $data['city_list'] = $this->c_model->getAllData('city_list', 'id,state_id,city_name', ['status' => 'Active']);
            $where = [];
            $data['get_class_name'] = '';
            $data['subject_class_name'] = '';
            // Store location in session if available
            if (!empty($get['location'])) {
                $this->session->set('session_city', $get['location']);
            }
            // Update session_city if city is provided
            if (!empty($get['city'])) {
                $this->session->set('session_city', $get['city']);
            }
            // Default conditions
            $where['status'] = 'Active';
            $where['kyc_status'] = 'Approved';
            // Retrieve session city
            $session_city = session()->get('session_city');
            // If session city is available, use it for filtering
            if (!empty($session_city)) {
                $cityId = getCityIdFromName($session_city);
                $where['city'] = $cityId;
            }
            // Process other filters
            if (!empty($get['board'])) {
                $data['board'] = $get['board'];
                $boardId = $get['board'];
                $where['FIND_IN_SET("' . $boardId . '", board) >'] = 0;
            }
            if (!empty($get['class'])) {
                $data['field_name'] = 'class';
                $data['field_value'] = $get['class'];
                $data['get_class_name'] = getClassName($get['class']);
               // echo $data['get_class_name'];exit;
                $data['subject_class_name'] = urldecode($data['get_class_name']);
                $classId = $get['class'];
                $where['FIND_IN_SET("' . $classId . '", class) >'] = 0;
            }
            if (!empty($get['class_name'])) {
                $data['field_name'] = 'class_name';
                $data['field_value'] = $get['class_name'];
                $data['get_class_name'] = urldecode($get['class_name']);
                $data['subject_class_name'] = urldecode($get['class_name']);
                $classId = getClassId($get['class_name']);
                $where['FIND_IN_SET("' . $classId . '", class) >'] = 0;
            }
            if (!empty($get['subject'])) {
                $data['field_name'] = 'subject';
                $data['field_value'] = $get['subject'];
                $data['subject'] = $get['subject'];
                $data['subject_id'] = $get['subject'];
                $subjectId = $get['subject'];
                $where['FIND_IN_SET("' . $subjectId . '", subject) >'] = 0;
            }
            if (!empty($get['gender'])) {
                $data['gender'] = $get['gender'];
                $where['gender'] = $get['gender'];
            }
            if (!empty($get['board_name'])) {
                $boardId = getBoardId($get['board_name']);
                $where['FIND_IN_SET("' . $boardId . '", board) >'] = 0;
            }
            if (!empty($get['subject_name'])) {
                $data['field_name'] = 'subject_name';
                $data['field_value'] = $get['subject_name'];
                $subjectId = getSubjectId($get['subject_name']);
                $data['subject_id'] = $subjectId;
                $data['subject_class_name'] = urldecode($get['subject_name']);
                if (count(explode(',', $subjectId)) > 1) {
                    $where['subject IN (' . $subjectId . ')'] = null;
                } else {
                    $where['FIND_IN_SET("' . $subjectId . '", subject) >'] = 0;
                }
            }
            // Update location based on city if provided
            if (!empty($get['city'])) {
                $this->session->set('session_city', $get['city']);
                $data['location'] = !empty($session_city) ? $session_city : $get['city'];
                $cityId = getCityIdFromName($data['location']);
                $where['city'] = $cityId;
            }
            if (!empty($get['area'])) {
                $data['area'] = urldecode($get['area']);
                $where['address LIKE'] = '%' . urldecode($get['area']) . '%';
            }
            if (isset($get['class_group']) && !empty($get['class_group'])) {
                $class_group_id = getClassGroupId($get['class_group']);
                $class_ids = getMultipleClassIds($class_group_id);
                if (!empty($class_ids) && count(explode(',', $class_ids)) > 1) {
                    $where['class IN (' . $class_ids . ')'] = null;
                } else {
                    $where['FIND_IN_SET("' . $class_ids . '", class) >'] = 0;
                }
            }
            $data['tutor_list'] = $this->c_model->getAllData('tutor_list', 'id,tutor_slug,tutor_name,address,profile_image,city,experience_years,gender,board,monthly_fees,subject,class,avg_rating,total_reviews', $where, 10, null, 'DESC', 'id');
            //echo $this->c_model->getLastQuery();exit;
            $data['board_list'] = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active']);
            $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active']);
            $joinArray[0]['table'] = 'dt_city_list as b';
            $joinArray[0]['join_on'] = 'a.city_id = b.id';
            $joinArray[0]['join_type'] = 'INNER';
            $whereArea = [];
            $whereArea['a.status'] = 'Active';
            $whereArea['a.is_popular'] = 'Yes';
            $cityId = '';
            if (!empty($get['city'])) {
                $cityId = !empty($session_city) ? getCityIdFromName($session_city) : $get['city'];
            }
            if (!empty($get['location'])) {
                $cityId = !empty($session_city) ? getCityIdFromName($session_city) : $get['location'];
            }
            if (!empty($session_city)) {
                $cityId = getCityIdFromName($session_city);
            }
            if (!empty($cityId)) {
                $whereArea['a.city_id'] = $cityId;
            }
            $data['city_area_list'] = $this->c_model->getAllData('area_list as a', 'a.id,a.area_name,b.id as cid,b.city_name', $whereArea, null, null, 'DESC', 'id', null, $joinArray);
            frontView('tutor-listing', $data);
        }
    }
    public function LoadBlogsDetails($page) {
        $data = [];
        $company = webSetting('*');
        $session_city = session()->get('session_city');
        $data['location'] = !empty($session_city) ? $session_city : '';
        $data['og_image'] = !empty($page['banner_image_jpg']) ? base_url('uploads/') . ($page['banner_image_jpg']) : base_url('uploads/') . ($company['logo_jpg']);
        $data['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : '';
        $data['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $data['meta_keyword'] = !empty($page['meta_keyword']) ? $page['meta_keyword'] : '';
        $data['page'] = $page;
        $data['featured_blogs'] = $this->c_model->getAllData('blogs_list', 'id,blog_title,blog_image_jpg,blog_image_webp,blog_image_alt,slug', ['status' => 'Active', 'slug != ' => $page['slug']]);
        $data['class_group_list'] = $this->c_model->getAllData('class_group_list', 'id,class_group_name', ['status' => 'Active']);
        $data['subject_list'] = $this->c_model->getAllData('subject_list', 'id,subject_name,image_jpg,image_webp,image_alt', ['status' => 'Active']);
        $session_city = session()->get('session_city');
        // If session city is available, use it for filtering
        $where=[];
        $where['status'] = 'Active';
        $where['kyc_status'] = 'Approved';
        if (!empty($session_city)) {
            $cityId = getCityIdFromName($session_city);
            $where['city'] = $cityId;
        }
        $data['tutor_list'] = $this->c_model->getAllData('tutor_list', 'id,tutor_slug,tutor_name,profile_image,city,experience_years,gender,monthly_fees,subject,class,avg_rating,total_reviews',$where, 6, null, 'DESC', 'id');
        frontView('blog-details', $data);
    }
    public function LoadTutorDetails($tutor) {
        $data = [];
        $company = webSetting('*');
        $session_city = session()->get('session_city');
        if (strpos($tutor['tuition_mode'], 'At ') !== false) {
            // Remove the keyword from the string
            $mode = str_replace('At ', "", $tutor['tuition_mode']);
        } else {
            $mode = $tutor['tuition_mode'];
        }
        $data['location'] = !empty($session_city) ? $session_city : '';
        $subjects = explode(',', getMultipleSubject($tutor['subject']));
        $skills = explode(',', getMultipleSkill($tutor['skill']));
        // Limiting to two subjects and two skills
        $limitedSubjects = array_slice($subjects, 0, 2);
        $limitedSkills = array_slice($skills, 0, 2);
        $cityName = getCityName($tutor['city']);
        $meta_title = $tutor['tutor_name'] . ' ' . $mode . ' Tutor in ' . $cityName . ', ' . implode(',', $limitedSubjects) . ', ' . implode(',', $limitedSkills);
        $meta_keywords = getMultipleSkill($tutor['skill']) . ' ' . $mode . ' Tutor in ' . $cityName . ', ' . getMultipleSubject($tutor['subject']) . ' ' . $mode . ' Tutor in ' . $cityName;
        $meta_description = $tutor['tutor_name'] . ' Best ' . $mode . ' Tutor in ' . ($tutor['address']) . ' for ' . implode(',', $limitedSubjects) . ', ' . implode(',', $limitedSkills) . ' Hire Now!';
        $saveTutorMeta = ['meta_title' => $meta_title, 'meta_keyword' => $meta_keywords, 'meta_description' => $meta_description];
        $this->c_model->updateRecords('tutor_list', $saveTutorMeta, ['id' => $tutor['id']]);
        $data['meta_title'] = !empty($tutor['meta_title']) ? $tutor['meta_title'] : $meta_title;
        $data['meta_description'] = !empty($tutor['meta_description']) ? $tutor['meta_description'] : $meta_description;
        $data['meta_keyword'] = !empty($tutor['meta_keyword']) ? $tutor['meta_keyword'] : $meta_keywords;
        $data['tutor'] = $tutor;
        $joinArray = [];
        $table = 'dt_city_list as a';
        $joinArray[0]['table'] = 'dt_state_list as b';
        $joinArray[0]['join_on'] = 'a.state_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $data['city_list'] = $this->c_model->getAllData($table, 'a.id,a.state_id,a.city_name,b.state_name', ['a.status' => 'Active'], null, null, null, null, null, $joinArray);
        // echo "<pre>";
        // print_r($data['city_list']);exit;
        $data['board_list'] = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active']);
        $data['class_list'] = $this->c_model->getAllData('class_list', 'id,class_name', ['status' => 'Active']);
        $where = ['status' => 'Active', 'FIND_IN_SET("' . $tutor['city'] . '", city_id) >' => 0];
        $data['banner'] = $this->c_model->getSingle('banner_list', 'banner_image_jpg, banner_image_webp, banner_image_alt', $where);
        if (!empty($tutor['profile_image'])) {
            $data['og_image'] = base_url('uploads/') . ($tutor['profile_image']);
        } else {
            // Assuming $company is defined elsewhere
            $data['og_image'] = base_url('uploads/') . ($company['logo_jpg']);
        }
        $data['faq_list'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['table_id' => $tutor['city'], 'table_name' => 'dt_city_list']);
        $query = 'SELECT name, testimonial, rating, location FROM dt_testimonial_list WHERE status = ? AND tutor_id = ? ORDER BY RAND() LIMIT 6';
        $bindings = ['Active', $tutor['id']];
        $data['reviews'] = db()->query($query, $bindings)->getResultArray();
        frontView('detail-page', $data);
    }
    public function LoadSeoDetails($page, $url) {
        // echo "<pre>";
        // print_r($page);exit;
        $data = [];
        $company = webSetting('*');
        $session_city = session()->get('session_city');
        $data['board']=!empty($this->request->getGet('board'))?getBoardId($this->request->getGet('board')):'';
        $data['location'] = !empty($session_city) ? $session_city : '';
        $data['og_image'] = !empty($page['image_jpg']) ? base_url('uploads/') . ($page['image_jpg']) : base_url('uploads/') .($company['logo_jpg']);
        $data['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : '';
        $data['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $data['meta_keyword'] = !empty($page['meta_keyword']) ? $page['meta_keyword'] : '';
        $data['page'] = $page;
        $data['page_url'] = base_url($url);
        $data['board_list'] = $this->c_model->getAllData('boards_list', 'id,board_name', ['status' => 'Active']);
        $data['faq_list'] = $this->c_model->getAllData('faq_master', 'id,question,answer', ['table_id' => $page['id'], 'table_name' => 'dt_city_area_seo_pages'], null, null, null, null, 'question');
        $where = [];
        $where['status'] = 'Active';
        $where['kyc_status'] = 'Approved';
        $where['FIND_IN_SET("' . ($page['city_id']) . '", city) >'] = 0;
        if ($page['template_table'] == "dt_boards_list") {
            $where['FIND_IN_SET("' . ($page['original_table_id']) . '", board) >'] = 0;
        } else if ($page['template_table'] == "dt_class_list") {
            $where['FIND_IN_SET("' . ($page['original_table_id']) . '", class) >'] = 0;
        } else if ($page['template_table'] == "dt_subject_list") {
            $where['FIND_IN_SET("' . ($page['original_table_id']) . '", subject) >'] = 0;
        }
        $fields = 'id,tutor_slug,tutor_name,address,profile_image,city,experience_years,gender,monthly_fees,subject,class,avg_rating,total_reviews';
        $limit = 10;
        $offset = null;
        $order_by = 'DESC';
        $primary_key = 'id';
        $data['tutor_list'] = $this->c_model->getAllData('tutor_list', $fields, $where, $limit, $offset, $order_by, $primary_key);
        frontView('seo-page-detail', $data);
    }
}
