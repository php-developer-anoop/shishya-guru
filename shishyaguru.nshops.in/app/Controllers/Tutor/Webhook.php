<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Webhook extends BaseController {
    public $c_model;
    public function __construct() {
        $this->c_model = new Common_model();
    }
    public function index() {
        
        
    }
    
}