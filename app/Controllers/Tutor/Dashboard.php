<?php
namespace App\Controllers\Tutor;
use App\Controllers\BaseController;
class Dashboard extends BaseController {
    public function index() {
        $data['meta_title'] = 'Dashboard - Tutor Panel';
        $data['meta_description'] = 'Dashboard - Tutor Panel';
        $data['meta_keyword'] = 'Dashboard - Tutor Panel';
        $user = tutorProfile();
        $data['reviews'] = db()->query('SELECT name,testimonial,rating,location,add_date FROM dt_testimonial_list  WHERE status="Active" AND tutor_id='.$user['id'].' ORDER BY id DESC')->getResultArray();
        $data['leads'] = db()->query("SELECT id, name, mobile_no, city_id, class_id, city_name, class_name, board_name, subject_name, tuition_mode 
                                FROM dt_leads_list  
                                WHERE lead_status='New'
                                AND city_id=" . $user['city'] . " 
                                AND subject_id IN (" . $user['subject'] . ") 
                                AND class_id IN (" . $user['class'] . ") 
                                AND lead_count <= " . LEADS_COUNT . "  ORDER BY id DESC
                                ")->getResultArray();
                // echo db()->getLastQuery();exit;
        tutorView('dashboard', $data);
    }
    public function getCount() {
        $user = tutorProfile();
        $type = $this->request->getVar('type') ??"";
        $where = '';
        if ($type == "accepted") {
            $where.= ' AND lead_status = "Accepted"';
            $query = db()->query('SELECT count(id) as total FROM dt_leads_list WHERE city_id = ' . $user['city'] . ' AND subject_id IN (' . $user['subject'] . ') AND class_id IN (' . $user['class'] . ') AND FIND_IN_SET(' . $user['id'] . ', accepted_by) > 0' . $where);
        } else {
            $where.= ' AND lead_status = "Assigned"';
            $query = db()->query('SELECT count(id) as total FROM dt_leads_list WHERE assigned_tutor_id=' . $user['id'] . '' . $where);
        }
        // echo db()->getLastQuery();exit;
        $count = $query->getRowArray();
        echo $count['total'];
    }
}
?>