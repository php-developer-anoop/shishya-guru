<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\Common_model;
class Area extends BaseController {
    protected $c_model;
    protected $session;
    protected $table;
    public function __construct() {
        $this->session = session();
        $this->c_model = new Common_model();
        $this->table = 'dt_area_list';
    }
    public function index() {
        $data['menu'] = 'Area Master';
        $data['title'] = 'Area List';
        adminView('area-list', $data);
    }
    function add_area() {
        $id = !empty($this->request->getVar('id')) ? $this->request->getVar('id') : '';
        $data = [];
        $data["menu"] = "Area Master";
        $data["title"] = !empty($id) ? "Edit Area" : "Add Area";
        $savedData = $this->c_model->getSingle($this->table, '*', ['id' => $id]);
        $data['id'] = !empty($savedData['id']) ? $savedData['id'] : $id;
        $data['state_id'] = !empty($this->request->getVar('state_id')) ? $this->request->getVar('state_id') : '';
        $data['city_id'] = !empty($this->request->getVar('city_id')) ? $this->request->getVar('city_id') : '';
        $data['area_name'] = !empty($savedData['area_name']) ? $savedData['area_name'] : '';
        $data['status'] = !empty($savedData['status']) ? $savedData['status'] : 'Active';
        $data['area_list'] = !empty($data['state_id'] && $data['city_id']) ? $this->c_model->getAllData($this->table, 'id,area_name,status', ['state_id' => $data['state_id'], 'city_id' => $data['city_id']]) : [];
        adminView('add-area', $data);
    }
    public function save_area() {
        $post = $this->request->getVar();
        $id = !empty($post['id']) ? $post['id'] : '';
        if (!empty($post["area_name"])) {
            $area_data = [];
            $count = count($post["area_name"]);
            // Prepare data for insertion
            for ($i = 0;$i < $count;$i++) {
                if (empty($post["area_name"][$i])) {
                    continue;
                }
                $status_key = "status" . ($i + 1);
                $arr = ["state_id" => trim($post['state_id']), "city_id" => trim($post['city_id']), "area_name" => trim($post["area_name"][$i]), "status" => $post[$status_key][0], "add_date" => date('Y-m-d H:i:s') ];
                array_push($area_data, $arr);
            }
            if (!empty($area_data)) {
                // Check if there are existing records for the state_id
                $existing_records = $this->c_model->getAllData($this->table, 'area_name', ['state_id' => $post['state_id']]);
                if ($existing_records) {
                    // If existing records found, update existing and insert new records
                    foreach ($area_data as $area) {
                        $existing = false;
                        foreach ($existing_records as $existing_record) {
                            if ($area['area_name'] === $existing_record['area_name']) {
                                $existing = true;
                                break;
                            }
                        }
                        if (!$existing) {
                            $this->c_model->insertRecords($this->table, $area);
                        }
                    }
                    $this->session->setFlashData('success', 'Data Added Successfully');
                } else {
                    // If no existing records found, insert all new records
                    $this->c_model->insertBatchItems($this->table, $area_data);
                    $this->session->setFlashData('success', 'Data Added Successfully');
                }
            } else {
                $this->session->setFlashData('error', 'No data to add');
            }
        }
        return redirect()->to(base_url(ADMINPATH . 'area-list?city_id='.$post['city_id'].'&state_id='.$post['state_id']));
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
            $where[" dt_area_list.area_name LIKE '%" . $searchString . "%'"] = null;
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
        $this->table = 'dt_area_list as a';
        $joinArray[0]['table'] = 'dt_city_list as b';
        $joinArray[0]['join_on'] = 'a.city_id = b.id';
        $joinArray[0]['join_type'] = 'INNER';
        $joinArray[1]['table'] = 'dt_state_list as c'; // Change the index to 1
        $joinArray[1]['join_on'] = 'a.state_id = c.id'; // Change the index to 1
        $joinArray[1]['join_type'] = 'INNER'; // Change the index to 1
        $select = 'a.*, DATE_FORMAT(a.add_date, "%d-%m-%Y %r") AS add_date, b.city_name, c.state_name'; // Adjust the column names according to table aliases
        $listData = $this->c_model->getAllData($this->table, $select, $where, $limit, $start, $orderby, 'id', null, $joinArray);
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