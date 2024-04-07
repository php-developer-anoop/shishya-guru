<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Testimonial extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_testimonial_list';
    }
    public function index() {
        $data['menu'] = 'Testimonial Master';
        $data['title'] = 'Testimonial List';
        adminView('testimonial-list', $data);
    }
    function add_testimonial() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Testimonial Master";
        $data["title"] = !empty($id) ? "Edit Testimonial" : "Add Testimonial";
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['name'] = !empty($savedData['name']) ? $savedData['name'] : '';
        $data['tutor'] = !empty($savedData['tutor']) ? $savedData['tutor'] : '';
        $data['testimonial'] = !empty($savedData['testimonial']) ? $savedData['testimonial'] : '';
        $data['location'] = !empty($savedData['location']) ? $savedData['location'] : '';
        $data['rating'] = !empty($savedData['rating']) ? $savedData['rating'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        adminView('add-testimonial', $data);
    }
    public function save_testimonial() {
    $post = $this->request->getVar();
    $id = !empty($post['id']) ? $post['id'] : '';
    $data = [
        'name' => trim($post['name']),
        'location' => trim($post['location']),
        'tutor' => trim($post['tutor']),
        'testimonial' => trim($post['testimonial']),
        'rating' => trim($post['rating']),
        'status' => trim($post['status'])
    ];

    if (empty($id)) {
        $data['add_date'] = date('Y-m-d H:i:s');
        $last_id = $this->c_model->insertRecords($this->table, $data);
        $this->session->setFlashData('success', 'Data Inserted Successfully');
    } else {
        $data['update_date'] = date('Y-m-d H:i:s');
        $this->c_model->updateRecords($this->table, $data, ['id' => $id]);
        $records = $this->c_model->getSingle($this->table, 'tutor_id,status', ['id' => $id]);
        if (!empty($records) && $records['status'] == "Active") {
            $tutor_id = $records['tutor_id'];
            $tutor_rating = $this->c_model->getSingle($this->table, 'AVG(rating) as avg_rating, COUNT(id) as total', ['tutor_id' => $tutor_id, 'status' => 'Active']);
            $this->c_model->updateRecords('tutor_list', ['avg_rating' => $tutor_rating['avg_rating'], 'total_reviews' => $tutor_rating['total']], ['id' => $tutor_id]);
        }
        $last_id = $id;
        $this->session->setFlashData('success', 'Data Updated Successfully');
    }

    return redirect()->to(base_url(ADMINPATH . 'testimonial-list'));
}

    public function getRecords() {
        $post = $this->request->getVar();
        $get = $this->request->getVar();
        $limit = (int)(!empty($get["length"]) ? $get["length"] : 1);
        $start = (int)!empty($get["start"]) ? $get["start"] : 0;
        $is_count = !empty($post["is_count"]) ? $post["is_count"] : "";
        $totalRecords = !empty($get["recordstotal"]) ? $get["recordstotal"] : 0;
        $orderby = "DESC";
        $where = [];
        $searchString = null;
        if (!empty($get["search"]["value"])) {
            $searchString = trim($get["search"]["value"]);
            $where[" name LIKE '%" . $searchString . "%' OR location LIKE '%" . $searchString . "%'"] = null;
            $limit = 100;
            $start = 0;
        }
        $countData = $this->c_model->countRecords($this->table, $where, 'id');
        if ($is_count == "yes") {
            echo (int)(!empty($countData) ? sizeof($countData) : 0);
            exit();
        }
        if (!empty($get["showRecords"])) {
            $limit = $get["showRecords"];
            $orderby = "DESC";
        }
        $select = '*, DATE_FORMAT(add_date , "%d-%m-%Y %r") AS add_date, DATE_FORMAT(update_date , "%d-%m-%Y %r") AS update_date';
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id');
        $result = [];
        if (!empty($listData)) {
            $i = $start + 1;
            foreach ($listData as $key => $value) {
                $push = [];
                $push = $value;
                $push["sr_no"] = $i;
                array_push($result, $push);
                $i++;
            }
        }
        $json_data = [];
        if (!empty($get["search"]["value"])) {
            $countItems = !empty($result) ? count($result) : 0;
            $json_data["draw"] = intval($get["draw"]);
            $json_data["recordsTotal"] = intval($countItems);
            $json_data["recordsFiltered"] = intval($countItems);
            $json_data["data"] = !empty($result) ? $result : [];
        } else {
            $json_data["draw"] = intval($get["draw"]);
            $json_data["recordsTotal"] = intval($totalRecords);
            $json_data["recordsFiltered"] = intval($totalRecords);
            $json_data["data"] = !empty($result) ? $result : [];
        }
        echo json_encode($json_data);
    }
}
?>