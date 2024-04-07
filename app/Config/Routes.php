<?php
use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get(ADMINPATH . "login", "Authentication::index", ["namespace" => "App\Controllers\Admin"]);
$routes->post(ADMINPATH . "checkLogin", "Authentication::checkLogin", ["namespace" => "App\Controllers\Admin"]);
$routes->get(ADMINPATH . "logout", "Authentication::logout", ["namespace" => "App\Controllers\Admin"]);
$routes->get(ADMINPATH . "dashboard", "Dashboard::index", ["filter" => "auth", "namespace" => "App\Controllers\Admin"]);
$routes->group("admin", ["filter" => 'auth', "namespace" => "App\Controllers\Admin"], function ($routes) {
    //Web Setting
    $routes->match(["get", "post"], "websetting", "Websetting::index");
    $routes->match(["get", "post"], "save/websetting", "Websetting::save_setting");
    //Home Setting
    $routes->match(["get", "post"], "home-setting", "Homesetting::index");
    $routes->match(["get", "post"], "save/homesetting", "Homesetting::save_homesetting");
    //Ajax
    $routes->match(["get", "post"], "changeStatus", "Ajax::index");
    $routes->match(["get", "post"], "changePopular", "Ajax::changePopular");
    $routes->match(["get", "post"], "delCity", "Ajax::delCity");
    $routes->match(["get", "post"], "delArea", "Ajax::delArea");
    $routes->match(["get", "post"], "delFaq", "Ajax::delFaq");
    $routes->match(["get", "post"], "getCount", "Ajax::getCount");
    $routes->match(["get", "post"], "getSlug", "Ajax::getSlug");
    $routes->match(["get", "post"], "getCities", "Ajax::getCities");
    $routes->match(["get", "post"], "delFees", "Ajax::delFees");
    $routes->match(["get", "post"], "changeKycStatus", "Ajax::changeKycStatus");
    $routes->match(["get", "post"], "getTypeList", "Ajax::getTypeList");
    $routes->match(["get", "post"], "getList", "Ajax::getList");
    $routes->match(["get", "post"], "deleteRecord", "Ajax::deleteRecord");
    $routes->match(["get", "post"], "refillWallet", "Ajax::refillWallet");
    $routes->match(["get", "post"], "cancelLead", "Ajax::cancelLead");
    $routes->match(["get", "post"], "getAcceptedTutors", "Ajax::getAcceptedTutors");
    $routes->match(["get", "post"], "assignTutor", "Ajax::assignTutor");
    $routes->match(["get", "post"], "appendDetails", "Ajax::appendDetails");
    $routes->match(["get", "post"], "changeRechargeStatus", "Ajax::changeRechargeStatus");
    // State Master
    $routes->match(["get", "post"], "state-list", "State::index");
    $routes->match(["get", "post"], "add-state", "State::add_state");
    $routes->match(["get", "post"], "save-state", "State::save_state");
    $routes->match(["get", "post"], "state-data", "State::getRecords");
    // City Master
    $routes->match(["get", "post"], "city-list", "City::index");
    $routes->match(["get", "post"], "add-city", "City::add_city");
    $routes->match(["get", "post"], "save-city", "City::save_city");
    $routes->match(["get", "post"], "save-city-image", "City::save_city_image");
    $routes->match(["get", "post"], "city-data", "City::getRecords");
    $routes->match(["get", "post"], "add-city-faq", "City::add_city_faq");
    $routes->match(["get", "post"], "save-city-faq", "City::save_city_faq");
    // Board Master
    $routes->match(["get", "post"], "board-list", "Boards::index");
    $routes->match(["get", "post"], "add-board", "Boards::add_board");
    $routes->match(["get", "post"], "save-board", "Boards::save_board");
    $routes->match(["get", "post"], "board-data", "Boards::getRecords");
    // Class Group Master
    $routes->match(["get", "post"], "class-group-list", "Class_group::index");
    $routes->match(["get", "post"], "add-class-group", "Class_group::add_class_group");
    $routes->match(["get", "post"], "save-class-group", "Class_group::save_class_group");
    $routes->match(["get", "post"], "class-group-data", "Class_group::getRecords");
    // Class Master
    $routes->match(["get", "post"], "class-list", "Classes::index");
    $routes->match(["get", "post"], "add-class", "Classes::add_class");
    $routes->match(["get", "post"], "save-class", "Classes::save_class");
    $routes->match(["get", "post"], "class-data", "Classes::getRecords");
    // Area Master
    $routes->match(["get", "post"], "area-list", "Area::index");
    $routes->match(["get", "post"], "add-area", "Area::add_area");
    $routes->match(["get", "post"], "save-area", "Area::save_area");
    $routes->match(["get", "post"], "area-data", "Area::getRecords");
    // FAQ Master
    $routes->match(["get", "post"], "faq-list", "Faq::index");
    $routes->match(["get", "post"], "add-faq", "Faq::add_faq");
    $routes->match(["get", "post"], "save-faq", "Faq::save_faq");
    $routes->match(["get", "post"], "faq-data", "Faq::getRecords");
    // SEO Master
    $routes->match(["get", "post"], "seo-page-list", "Seo_pages::index");
    $routes->match(["get", "post"], "add-seo-page", "Seo_pages::add_seo_page");
    $routes->match(["get", "post"], "save-seo-page", "Seo_pages::save_seo_page");
    $routes->match(["get", "post"], "seo-page-data", "Seo_pages::getRecords");
    // Subject Master
    $routes->match(["get", "post"], "subject-list", "Subject::index");
    $routes->match(["get", "post"], "add-subject", "Subject::add_subject");
    $routes->match(["get", "post"], "save-subject", "Subject::save_subject");
    $routes->match(["get", "post"], "subject-data", "Subject::getRecords");
    // Skill Master
    $routes->match(["get", "post"], "skill-list", "Skill::index");
    $routes->match(["get", "post"], "add-skill", "Skill::add_skill");
    $routes->match(["get", "post"], "save-skill", "Skill::save_skill");
    $routes->match(["get", "post"], "skill-data", "Skill::getRecords");
    //Blog Category Master
    $routes->match(["get", "post"], "blog-category-list", "Blog_category::index");
    $routes->match(["get", "post"], "add-blog-category", "Blog_category::add_blog_category");
    $routes->match(["get", "post"], "save-blog-category", "Blog_category::save_blog_category");
    $routes->match(["get", "post"], "blog-category-data", "Blog_category::getRecords");
    //Blog Master
    $routes->match(["get", "post"], "blog-list", "Blogs::index");
    $routes->match(["get", "post"], "add-blog", "Blogs::add_blog");
    $routes->match(["get", "post"], "save-blog", "Blogs::save_blog");
    $routes->match(["get", "post"], "blog-data", "Blogs::getRecords");
    //Qualification Master
    $routes->match(["get", "post"], "qualification-list", "Qualification::index");
    $routes->match(["get", "post"], "add-qualification", "Qualification::add_qualification");
    $routes->match(["get", "post"], "save-qualification", "Qualification::save_qualification");
    $routes->match(["get", "post"], "qualification-data", "Qualification::getRecords");
    //Testimonial Master
    $routes->match(["get", "post"], "testimonial-list", "Testimonial::index");
    $routes->match(["get", "post"], "add-testimonial", "Testimonial::add_testimonial");
    $routes->match(["get", "post"], "save-testimonial", "Testimonial::save_testimonial");
    $routes->match(["get", "post"], "testimonial-data", "Testimonial::getRecords");
    //Banner Master
    $routes->match(["get", "post"], "banner-list", "Banner::index");
    $routes->match(["get", "post"], "add-banner", "Banner::add_banner");
    $routes->match(["get", "post"], "save-banner", "Banner::save_banner");
    $routes->match(["get", "post"], "banner-data", "Banner::getRecords");
    //Lead Charge Master
    $routes->match(["get", "post"], "lead-list", "Lead::index");
    $routes->match(["get", "post"], "add-lead", "Lead::add_lead");
    $routes->match(["get", "post"], "save-lead", "Lead::save_lead");
    $routes->match(["get", "post"], "lead-data", "Lead::getRecords");
    //Tuition Fee Master
    $routes->match(["get", "post"], "tuition-fee-list", "Tuition_fee::index");
    $routes->match(["get", "post"], "add-tuition-fee", "Tuition_fee::add_tuition_fee");
    $routes->match(["get", "post"], "save-tuition-fee", "Tuition_fee::save_tuition_fee");
    $routes->match(["get", "post"], "tuition-fee-data", "Tuition_fee::getRecords");
    // Area Seo Page Master
    $routes->match(["get", "post"], "area-seo-page-list", "Area_seo_pages::index");
    $routes->match(["get", "post"], "add-area-seo-page", "Area_seo_pages::add_area_seo_page");
    $routes->match(["get", "post"], "save-area-seo-page", "Area_seo_pages::save_area_seo_page");
    $routes->match(["get", "post"], "area-seo-page-data", "Area_seo_pages::getRecords");
    //CMS Master
    $routes->match(["get", "post"], "cms-list", "Cms::index");
    $routes->match(["get", "post"], "add-cms", "Cms::add_cms");
    $routes->match(["get", "post"], "save-cms", "Cms::save_cms");
    $routes->match(["get", "post"], "cms-data", "Cms::getRecords");
    //Recharge Plan Master
    $routes->match(["get", "post"], "plan-list", "Recharge_plan::index");
    $routes->match(["get", "post"], "add-plan", "Recharge_plan::add_plan");
    $routes->match(["get", "post"], "save-plan", "Recharge_plan::save_plan");
    $routes->match(["get", "post"], "plan-data", "Recharge_plan::getRecords");
    //Leads List
    $routes->match(["get", "post"], "leads-list", "Leads_list::index");
    $routes->match(["get", "post"], "leads-list-data", "Leads_list::getRecords");
    //General Query List
    $routes->match(["get", "post"], "query-list", "Query::index");
    $routes->match(["get", "post"], "query-data", "Query::getQueryRecords");
    //Tutor  List
    $routes->match(["get", "post"], "tutor-list", "Tutor::index");
    $routes->match(["get", "post"], "tutor-data", "Tutor::getRecords");
    $routes->match(["get", "post"], "edit-tutor", "Tutor::edit_tutor");
    $routes->match(["get", "post"], "save-tutor", "Tutor::save_tutor");
    //Wallet  List
    $routes->match(["get", "post"], "wallet-history", "Wallet::index");
    $routes->match(["get", "post"], "wallet-data", "Wallet::getRecords");
    // Seo Template
    $routes->match(["get", "post"], "add-seo-template", "Seo_templates::index");
    $routes->match(["get", "post"], "save-seo-template", "Seo_templates::save_seo_template");
    // Configure City Seo Page
    $routes->match(["get", "post"], "configure-city-seo-page", "City_seo_page::index");
    $routes->match(["get", "post"], "save-city-seo-page", "City_seo_page::save_city_seo_page");
    $routes->match(["get", "post"], "city-seo-page-data", "City_seo_page::getRecords");
    $routes->match(["get", "post"], "city-seo-page-list", "City_seo_page::city_seo_page_list");
    $routes->match(["get", "post"], "edit-city-seo-page", "City_seo_page::edit_city_seo_page");
    $routes->match(["get", "post"], "update-city-seo-page", "City_seo_page::update_city_seo_page");
    // Schedule Master
    $routes->match(["get", "post"], "schedule-list", "Schedule::index");
    $routes->match(["get", "post"], "add-schedule", "Schedule::add_schedule");
    $routes->match(["get", "post"], "save-schedule", "Schedule::save_schedule");
    $routes->match(["get", "post"], "schedule-data", "Schedule::getRecords");
    // Schedule Data
    $routes->match(["get", "post"], "all-schedule-list", "Schedule_list::index");
    $routes->match(["get", "post"], "all-schedule-data", "Schedule_list::getRecords");    
    // Recharge Request Data
    $routes->match(["get", "post"], "recharge-request-list", "Recharge_request_list::index");
    $routes->match(["get", "post"], "recharge-request-data", "Recharge_request_list::getRecords");  
   
    
});

// Tutor Routes
$routes->get(TUTORPATH . "login", "Authentication::index", ["namespace" => "App\Controllers\Tutor"]);
$routes->get(TUTORPATH . "sendForgotPassword", "Authentication::sendForgotPassword", ["namespace" => "App\Controllers\Tutor"]);
$routes->post(TUTORPATH . "checkLogin", "Authentication::checkLogin", ["namespace" => "App\Controllers\Tutor"]);
$routes->get(TUTORPATH . "logout", "Authentication::logout", ["namespace" => "App\Controllers\Tutor"]);
$routes->get(TUTORPATH . "dashboard", "Dashboard::index", ["filter" => "tutor", "namespace" => "App\Controllers\Tutor"]);
$routes->group("tutor", ["filter" => 'tutor', "namespace" => "App\Controllers\Tutor"], function ($routes) {
    $routes->match(["get", "post"], "my-profile", "Profile::index");
    $routes->match(["get", "post"], "setting", "Profile::setting");
    $routes->match(["get", "post"], "save-setting", "Profile::save_setting");
    $routes->match(["get", "post"], "save-kyc-image", "Profile::save_kyc_image");
    $routes->match(["get", "post"], "save-personal-info", "Profile::save_personal_info");
    $routes->match(["get", "post"], "save-education-info", "Profile::save_education_info");
    $routes->match(["get", "post"], "save-tuition-info", "Profile::save_tuition_info");
    $routes->match(["get", "post"], "save-additional-info", "Profile::save_additional_info");
    $routes->match(["get", "post"], "course-list", "Course::index");
    $routes->match(["get", "post"], "add-course", "Course::add_course");
    $routes->match(["get", "post"], "reviews", "Review::index");
    $routes->match(["get", "post"], "blogs", "Blogs::index");
    //Leads 
    $routes->match(["get", "post"], "leads-list", "Leads::index"); 
    $routes->match(["get", "post"], "leads-list-data", "Leads::getRecords");
    $routes->match(["get", "post"], "showNumber", "Leads::showNumber");
    //Picked Leads
    $routes->match(["get", "post"], "picked-leads", "Leads::picked_leads");
    $routes->match(["get", "post"], "picked-leads-data", "Leads::getPickedRecords");
    //Active Leads
    $routes->match(["get", "post"], "active-tuitions", "Leads::active_tuitions");
    $routes->match(["get", "post"], "active-tuitions-data", "Leads::getActiveTuitions");
    //Wallet 
    $routes->match(["get", "post"], "my-wallet", "Wallet::index");
    $routes->match(["get", "post"], "my-wallet-data", "Wallet::my_wallet_records");
    // Recharge Request Data
    $routes->match(["get", "post"], "recharge-request-list", "Recharge_request_list::index");
    $routes->match(["get", "post"], "recharge-request-data", "Recharge_request_list::getRecords");  
    // Get Count 
    $routes->match(["get", "post"], "getCount", "Dashboard::getCount");
    // Save Schedule
    $routes->match(["get", "post"], "save-schedule", "Leads::save_schedule");
    //Get Token
    $routes->match(["get", "post"], "add-request", "Wallet::add_request");

});

// Frontend Routes
$routes->get("sitemap.xml", "Sitemap::index", ["namespace" => "App\Controllers"]);
$routes->get("(:any)", "Common::index", ["namespace" => "App\Controllers"]);
$routes->post("getPopularLocality", "Ajax::index", ["namespace" => "App\Controllers"]);
$routes->post("getSubject", "Ajax::getSubject", ["namespace" => "App\Controllers"]);
$routes->post("getMultipleClassSubject", "Ajax::getMultipleClassSubject", ["namespace" => "App\Controllers"]);
$routes->post("getFees", "Ajax::getFees", ["namespace" => "App\Controllers"]);
$routes->post("loadMoreTutors", "Ajax::loadMoreTutors", ["namespace" => "App\Controllers"]);
$routes->post("getRandomCaptcha", "Ajax::getRandomCaptcha", ["namespace" => "App\Controllers"]);
$routes->post("getReviews", "Ajax::getReviews", ["namespace" => "App\Controllers"]);
$routes->post("getSubjectClass", "Ajax::getSubjectClass", ["namespace" => "App\Controllers"]);
$routes->post("getTutors", "Ajax::getTutors", ["namespace" => "App\Controllers"]);
$routes->post("getLocation", "Ajax::getLocation", ["namespace" => "App\Controllers"]);
$routes->post("getCity", "Ajax::getCity", ["namespace" => "App\Controllers"]);
$routes->post("save-tutor-query", "Leads::index", ["namespace" => "App\Controllers"]);
$routes->post("saveQuery", "Ajax::saveQuery", ["namespace" => "App\Controllers"]);
$routes->post("setCity", "Ajax::setCity", ["namespace" => "App\Controllers"]);
$routes->post("checkSessionSetCity", "Ajax::checkSessionSetCity", ["namespace" => "App\Controllers"]);

$routes->post("sendOtp", "Home::sendOtp", ["namespace" => "App\Controllers"]);
$routes->post("resendOtp", "Home::resendOtp", ["namespace" => "App\Controllers"]);
$routes->post("verifyOtp", "Home::verifyOtp", ["namespace" => "App\Controllers"]);
$routes->post("save-tutor", "Home::save_tutor", ["namespace" => "App\Controllers"]);
$routes->post("checkUserVerification", "Home::checkUserVerification", ["namespace" => "App\Controllers"]);

$routes->post("validatePhoneNumber", "User::index", ["namespace" => "App\Controllers"]);
$routes->post("validateOtp", "User::validateOtp", ["namespace" => "App\Controllers"]);
$routes->post("validateReview", "User::validateReview", ["namespace" => "App\Controllers"]);
$routes->post("validateResendOtp", "User::validateResendOtp", ["namespace" => "App\Controllers"]);
