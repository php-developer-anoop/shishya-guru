<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
//use App\Models\Common_model;

class Dashboard extends BaseController
{
    public function index(){
        $data['title']='Dashboard';
        adminView('dashboard',$data);
    }
}
?>