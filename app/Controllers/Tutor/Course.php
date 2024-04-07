<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Course extends BaseController {
    public $c_model;
    protected $session;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
    }
    public function index() {
        $data['meta_title'] = 'Course List - Tutor Panel';
        $data['meta_description'] = 'Course List - Tutor Panel';
        $data['meta_keyword'] = 'Course List - Tutor Panel';
        tutorView('course-list', $data);
    }
    public function add_course() {
        $data['meta_title'] = 'Add Course - Tutor Panel';
        $data['meta_description'] = 'Add Course - Tutor Panel';
        $data['meta_keyword'] = 'Add Course - Tutor Panel';
        tutorView('add-course', $data);
    }
}