<?php
namespace App\Controllers;
use App\Models\Common_model;
class Sitemap extends BaseController {
    public $c_model;
    public function __construct() {
        $this->c_model = new Common_model();
    }
    function index() {
        $baseurl = base_url();
        $priority = '1.00';
        $gmtformat = date('c', time());
        $dataArrays = ['cms_list' => 'slug', 'tutor_list' => 'tutor_slug', 'blogs_list' => 'slug', 'city_area_seo_pages' => 'slug'];
        $this->response->setContentType('text/xml');
        $output = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $output.= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($dataArrays as $table => $slugField) {
            $data = $this->c_model->getAllData($table, $slugField, ['status' => 'Active']);
            foreach ($data as $key => $value) {
                $output.= "<url><loc>" . $baseurl . $value[$slugField] . '</loc><lastmod>' . $gmtformat . "</lastmod><priority>" . $priority . "</priority></url>\n";
            }
        }
        $output.= '</urlset>';
        echo $output;
    }
}
?>