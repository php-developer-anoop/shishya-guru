<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Blogs extends BaseController {
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
        tutorView('blogs', $data);
    }
    
}