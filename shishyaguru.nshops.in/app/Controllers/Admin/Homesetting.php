<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;

class Homesetting extends BaseController
{
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_homesetting';
    }
    public function index(){
        $data['title']='Home Setting';
        $data['home']=$this->c_model->getSingle($this->table);
        $data['about_list'] = !empty($data['home']['about_us_point']) ? array_map('trim', explode(',', json_encode($data['home']['about_us_point']))) : [];
        adminView('home-setting',$data);
    }
    public function save_homesetting() {
        $post = $this->request->getVar();
        // echo "<pre>";
        // print_r($post);exit;
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        if ($file = $this->request->getFile('top_banner')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file('uploads/' . $post['old_top_banner_jpg']) && file_exists(ROOTPATH . 'uploads/' . $post['old_top_banner_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_top_banner_jpg']);
                }
                if (is_file('uploads/' . $post['old_top_banner_webp']) && file_exists(ROOTPATH . 'uploads/' . $post['old_top_banner_webp'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_top_banner_webp']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $top_banner_webp = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['top_banner_jpg'] = $filename;
                $data['top_banner_webp'] = $top_banner_webp;
               
            }
        }
        if ($file = $this->request->getFile('top_background')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file('uploads/' . $post['old_top_bg_image_jpg']) && file_exists(ROOTPATH . 'uploads/' . $post['old_top_bg_image_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_top_bg_image_jpg']);
                }
                if (is_file('uploads/' . $post['old_top_bg_image_webp']) && file_exists(ROOTPATH . 'uploads/' . $post['old_top_bg_image_webp'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_top_bg_image_webp']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $top_bg_image_webp = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['top_bg_image_jpg'] = $filename;
                $data['top_bg_image_webp'] = $top_bg_image_webp;
               
            }
        }
        if ($file = $this->request->getFile('mid_banner')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file('uploads/' . $post['old_mid_banner_jpg']) && file_exists(ROOTPATH . 'uploads/' . $post['old_mid_banner_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_mid_banner_jpg']);
                }
                if (is_file('uploads/' . $post['old_mid_banner_webp']) && file_exists(ROOTPATH . 'uploads/' . $post['old_mid_banner_webp'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_mid_banner_webp']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $mid_banner_webp = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['mid_banner_jpg'] = $filename;
                $data['mid_banner_webp'] = $mid_banner_webp;
               
            }
        }
        if ($file = $this->request->getFile('free_demo_image')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file('uploads/' . $post['old_free_demo_image_jpg']) && file_exists(ROOTPATH . 'uploads/' . $post['old_free_demo_image_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_free_demo_image_jpg']);
                }
                if (is_file('uploads/' . $post['old_free_demo_image_webp']) && file_exists(ROOTPATH . 'uploads/' . $post['old_free_demo_image_webp'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_free_demo_image_webp']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $free_demo_image_webp = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['free_demo_image_jpg'] = $filename;
                $data['free_demo_image_webp'] = $free_demo_image_webp;
               
            }
        }
        if ($file = $this->request->getFile('bottom_banner')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                if (is_file('uploads/' . $post['old_bottom_banner_jpg']) && file_exists(ROOTPATH . 'uploads/' . $post['old_bottom_banner_jpg'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_bottom_banner_jpg']);
                }
                if (is_file('uploads/' . $post['old_bottom_banner_webp']) && file_exists(ROOTPATH . 'uploads/' . $post['old_bottom_banner_webp'])) {
                    @unlink(ROOTPATH . 'uploads/' . $post['old_bottom_banner_webp']);
                }
                $image = \Config\Services::image()->withFile($file)->save(ROOTPATH . '/uploads/' . $filename);
                $webp_file = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
                $bottom_banner_webp = convertImageInToWebp('uploads', $filename, $webp_file);
                $data['bottom_banner_jpg'] = $filename;
                $data['bottom_banner_webp'] = $bottom_banner_webp;
               
            }
        }
        $data['about_us_point'] = !empty($post['about_us_point'])?json_encode(($post['about_us_point'])):[];
        $data['top_heading'] = trim($post['top_heading']);
        $data['meta_title'] = trim($post['meta_title']);
        $data['meta_description'] = trim($post['meta_description']);
        $data['meta_keyword'] = trim($post['meta_keyword']);
        $data['top_banner_alt'] = trim($post['top_banner_alt']);
        $data['class_group_heading'] = trim($post['class_group_heading']);
        $data['subject_heading'] = trim($post['subject_heading']);
        $data['tutor_heading'] = trim($post['tutor_heading']);
        $data['mid_banner_alt'] = trim($post['mid_banner_alt']);
        $data['bottom_banner_image_alt'] = trim($post['bottom_banner_image_alt']);
        $data['top_bg_image_alt'] = trim($post['top_bg_image_alt']);
        $data['free_demo_image_alt'] = trim($post['free_demo_image_alt']);
        $data['about_us_heading'] = trim($post['about_us_heading']);
        $data['about_us_description'] = trim($post['about_us_description']);
        $data['city_heading'] = trim($post['city_heading']);
        $data['area_heading'] = trim($post['area_heading']);
        $data['blogs_heading'] = trim($post['blogs_heading']);
        $data['testimonial_heading'] = trim($post['testimonial_heading']);
        
        if (empty($id)) {
             $this->c_model->insertRecords($this->table, $data);
            $this->session->setFlashData('success', 'Data Added Successfully ');
        } else {
             $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
            $this->session->setFlashData('success', 'Data Updated Successfully');
        }
        return redirect()->to(base_url(ADMINPATH . 'home-setting'));
    }
}
?>