<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Review extends BaseController {
    public $c_model;
    protected $session;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
    }
    public function index() {
        $user=tutorProfile();
        $data['meta_title'] = 'Reviews - Tutor Panel';
        $data['meta_description'] = 'Reviews - Tutor Panel';
        $data['meta_keyword'] = 'Reviews - Tutor Panel';
        $data['reviews'] = db()->query('SELECT name,testimonial,rating,location,add_date FROM dt_testimonial_list  WHERE status="Active" AND tutor_id='.$user['id'].' ORDER BY id DESC')->getResultArray();
        tutorView('reviews', $data);
    }
    
}