<?php
if (!function_exists('db')) {
    function db() {
        $db = \Config\Database::connect();
        return $db;
    }
}
if (!function_exists('adminview')) {
    function adminView($pagename, $data) {
        $company = webSetting('*');
        $currentTime = time();
        $logoutTime = strtotime('00:00:00');
        if ($currentTime == $logoutTime) {
            session()->destroy();
            return redirect()->to(base_url());
        }
        $data['company'] = $company;
        $data['favicon'] = !empty($company['favicon']) ? base_url('uploads/') . $company['favicon'] : "";
        $data['logo'] = !empty($company['logo_jpg'] || $company['logo_webp']) ? base_url('uploads/') . imgExtension($company['logo_jpg'], $company['logo_webp']) : "";
        echo view(ADMINPATH . "includes/meta_file", $data);
        echo view(ADMINPATH . "includes/all_css", $data);
        echo view(ADMINPATH . "includes/header", $data);
        echo view(ADMINPATH . "includes/sidebar", $data);
        echo view(ADMINPATH . $pagename, $data);
        echo view(ADMINPATH . "includes/all_js", $data);
        echo view(ADMINPATH . "includes/footer", $data);
    }
}
if (!function_exists("frontView")) {
    function frontView($page_name, $data) {
        $company = webSetting('*');
        $currentTime = time();
        $logoutTime = strtotime('00:00:00');
        if ($currentTime == $logoutTime) {
            session()->destroy();
            return redirect()->to(base_url());
        }
        $data['company'] = $company;
        $data['home'] = homesetting('*');
        $data['favicon'] = !empty($company['favicon']) ? base_url('uploads/') . $company['favicon'] : "";
        $data['logo'] = !empty($company['logo_jpg'] || $company['logo_webp']) ? base_url('uploads/') . imgExtension($company['logo_jpg'], $company['logo_webp']) : "";
        $data['seo_pages'] = getData('seo_master', 'id,page_name,slug', ['status' => 'Active'], 12, null, 'id DESC');
        echo view("frontend/includes/meta_file", $data);
        echo view("frontend/includes/all_css", $data);
        echo view("frontend/includes/header", $data);
        echo view("frontend/" . $page_name, $data);
        echo view("frontend/includes/footer", $data);
        echo view("frontend/includes/all_js", $data);
    }
}
if (!function_exists("tutorView")) {
    function tutorView($page_name, $data) {
        $company = websetting('*');
        $profile = getTutorProfile();
        $currentTime = time();
        $logoutTime = strtotime('00:00:00');
        if($currentTime == $logoutTime){
            session()->destroy();
            return redirect()->to(base_url());
        }
        $data['company'] = $company;
        $data['homesetting'] = homesetting('*');
        $data['tutor'] = tutorProfile();
        $data['favicon'] = !empty($company['favicon']) ? base_url('uploads/') . $company['favicon'] : "";
        $data['logo'] = !empty($company['logo']) ? base_url('uploads/') . $company['logo'] : "";
        $data['profile_image'] = !empty($data['tutor']['profile_image']) ? base_url('uploads/') . $data['tutor']['profile_image'] : "";
        $data['tutor_name'] = !empty($data['tutor']['tutor_name']) ? $data['tutor']['tutor_name'] : "";
        $data['unique_id'] = !empty($data['tutor']['unique_id']) ? $data['tutor']['unique_id'] : "";
        echo view("tutor/includes/header", $data);
        echo view("tutor/" . $page_name, $data);
        echo view("tutor/includes/footer", $data);
    }
}
if (!function_exists("webSetting")) {
    function webSetting($select) {
        $company = db()->table('dt_setting')->select($select)->get()->getRowArray();
        return $company;
    }
}
if (!function_exists("homeSetting")) {
    function homeSetting($select) {
        $company = db()->table('dt_homesetting')->select($select)->get()->getRowArray();
        return $company;
    }
}
function getTutorProfile() {
    $session = session('tutor_login_data');
    return $session;
}
function tutorProfile() {
    $session = session('tutor_login_data');
    $tutor = getSingle('tutor_list', '*', ['mobile_no' => $session['mobile_no']]);
    return $tutor;
}
if (!function_exists("validate_slug")) {
    function validate_slug($text, string $divider = '-') {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = transliterator_transliterate('Any-Latin; Latin-ASCII', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }
}
if (!function_exists('convertImageInToWebp')) {
    function convertImageInToWebp($folderPath, $uploaded_file_name, $new_webp_file) {
        $source = $folderPath . '/' . $uploaded_file_name;
        $extension = pathinfo($source, PATHINFO_EXTENSION);
        $quality = 100;
        $image = '';
        if ($extension == 'jpeg' || $extension == 'jpg') {
            $image = imagecreatefromjpeg($source);
        } else if ($extension == 'gif') {
            $image = imagecreatefromgif($source);
        } else if ($extension == 'png') {
            $image = imagecreatefrompng($source);
            imagepalettetotruecolor($image);
        } else {
            $image = $uploaded_file_name;
        }
        $destination = $folderPath . '/' . $new_webp_file;
        $webp_upload_done = imagewebp($image, $destination, $quality);
        return $webp_upload_done ? $new_webp_file : '';
    }
}
if (!function_exists('count_data')) {
    function count_data($column, $table, $where = null) {
        $builder = db()->table($table);
        if (!empty($where)) {
            $builder->where($where);
        }
        $count = $builder->countAllResults($column);
         $lastQuery = db()->getLastQuery();
        return $count;
    }
}
function random_alphanumeric_string($length) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$&!=+';
    return substr(str_shuffle($chars), 0, $length);
}
function generate_password($length) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$';
    return substr(str_shuffle($chars), 0, $length);
}
function generate_numeric_password($length) {
    $chars = '0123456789';
    return substr(str_shuffle($chars), 0, $length);
}
function FetchExactBrowserName() {
    $userAgent = strtolower($_SERVER["HTTP_USER_AGENT"]);
    if (strpos($userAgent, "opr/") !== false) {
        return "Opera";
    } elseif (strpos($userAgent, "chrome/") !== false) {
        return "Chrome";
    } elseif (strpos($userAgent, "edg/") !== false) {
        return "Microsoft Edge";
    } elseif (strpos($userAgent, "msie") !== false || strpos($userAgent, "trident/") !== false) {
        return "Internet Explorer";
    } elseif (strpos($userAgent, "firefox/") !== false) {
        return "Firefox";
    } elseif (strpos($userAgent, "safari/") !== false && strpos($userAgent, "chrome/") === false) {
        return "Safari";
    } else {
        return "Unknown";
    }
}
function imgExtension($image_jpg_png_gif, $image_webp = null) {
    $browserName = FetchExactBrowserName();
    if ($browserName === "Chrome" && !empty($image_webp)) {
        return $image_webp;
    } elseif ($browserName === "Safari" && !empty($image_webp)) {
        return $image_webp;
    } else {
        return $image_jpg_png_gif;
    }
}
function getData($table, $keys = null, $where = null, $limit = null, $offset = null, $order_by = null, $groupby = null, $jointable = null, $join = null) {
    $builder = db()->table($table);
    if (!empty($keys)) {
        $builder->select($keys);
    }
    if (!empty($where)) {
        $builder->where($where);
    }
    if (!empty($limit) && !empty($offset)) {
        $builder->limit($limit, $offset);
    } elseif (!empty($limit) && empty($offset)) {
        $builder->limit($limit);
    }
    if (!empty($order_by)) {
        $builder->orderBy($order_by);
    }
    if (!empty($groupby)) {
        $builder->groupBy($groupby);
    }
    if (!empty($jointable) && !empty($join)) {
        $builder->join($jointable, $join);
    }
    return $builder->get()->getResultArray();
}
function getSingle($table, $keys = null, $where = null, $limit = null, $offset = null, $order_by = null) {
    $builder = db()->table($table);
    if (!empty($keys)) {
        $builder->select($keys);
    }
    if (!empty($where)) {
        $builder->where($where);
    }
    if (!empty($limit) && !empty($offset)) {
        $builder->limit($limit, $offset);
    } elseif (!empty($limit) && empty($offset)) {
        $builder->limit($limit);
    }
    if (!empty($orderby)) {
        $builder->orderBy($orderby);
    }
    return $builder->get()->getRowArray();
}
function showRatings($ratingValue) {
    $filledStar = '<i class="fa-solid fa-star"></i>';
    $filledStarsCount = $ratingValue;
    $emptyStarsCount = 5 - $ratingValue;
    $ratingsHTML = '';
    for ($i = 0;$i < $filledStarsCount;$i++) {
        $ratingsHTML.= $filledStar;
    }
    return $ratingsHTML;
}
function showTutorRatings($ratingValue) {
    $filledStar = '<i class="bi bi-star-fill ps-2"></i>';
    $filledStarsCount = $ratingValue;
    $emptyStarsCount = 5 - $ratingValue;
    $ratingsHTML = '';
    for ($i = 0;$i < $filledStarsCount;$i++) {
        $ratingsHTML.= $filledStar;
    }
    return $ratingsHTML;
}
if (!function_exists('getUri')) {
    function getUri($segment) {
        $uri = service('uri');
        $url = $uri->getSegment($segment);
        return $url;
    }
}
if (!function_exists("getFaqData")) {
    function getFaqData($where = false) {
        $builder = db()->table('dt_faq');
        return $builder->select('question,answer')->where($where)->get()->getResultArray();
    }
}
if (!function_exists("generateFaqSchema")) {
    function generateFaqSchema($faqData) {
        if (!empty($faqData)) {
            $count = count($faqData);
            $schema = ["@context" => "https://schema.org/", "@type" => "FAQPage", "mainEntity" => []];
            foreach ($faqData as $index => $faqItem) {
                $question = strip_tags($faqItem['question']);
                $answer = strip_tags($faqItem['answer']);
                $schema['mainEntity'][] = ["@type" => "Question", "name" => $question, "acceptedAnswer" => ["@type" => "Answer", "text" => $answer]];
            }
            $jsonSchema = json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            $scriptTag = '<script type="application/ld+json">' . PHP_EOL . $jsonSchema . PHP_EOL . '</script>' . PHP_EOL;
            return $scriptTag;
        } else {
            return false;
        }
    }
}
if (!function_exists('decryptPassword')) {
    function decryptPassword($cookieName, $domain = null) {
        $browser_token = get_cookie($cookieName, true, $domain);
        if ($browser_token) {
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $encryption_iv = '9102407892214621';
            $encryption_key = "281d8febfeee1bdc9ec24c5bb73de622";
            $decryption = openssl_decrypt($browser_token, $ciphering, $encryption_key, 0, $encryption_iv);
            $decrypted_data = json_decode($decryption, true);
            return $decrypted_data;
        } else {
            return null;
        }
    }
}
function testInput($input) {
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    return $input;
}
function getStateName($id) {
    $state = getSingle('state_list', 'state_name', ['id' => $id]);
    return !empty($state['state_name']) ? $state['state_name'] : '';
}
if (!function_exists("generateProductSchema")) {
    function generateProductSchema($name = false, $image = false, $description = false) {
        // $ratingValue = random_int(40, 50) / 10;
        $ratingValue = (int)4;
        $settingData = webSetting('logo_jpg,company_name');
        $brandname = $settingData['company_name'];
        if (!empty($image)) {
            $imagePath = base_url('uploads/' . $image);
        } else {
            $imagePath = base_url('uploads/') . $settingData['logo_jpg'];
        }
        $schema = '';
        $schema.= '<script type="application/ld+json">' . "\n";
        $schema.= '{' . "\n";
        $schema.= '"@context": "https://schema.org/",' . "\n";
        $schema.= '"@type": "Product", ' . "\n";
        $schema.= '"name": "' . $name . '",' . "\n";
        $schema.= '"image": "' . $imagePath . '",' . "\n";
        $schema.= '"description": "' . $description . '",' . "\n";
        $schema.= '"brand": {' . "\n";
        $schema.= '"@type": "Brand",' . "\n";
        $schema.= '"name": "' . $brandname . '"' . "\n";
        $schema.= '},' . "\n";
        $schema.= '"aggregateRating": {' . "\n";
        $schema.= '"@type": "AggregateRating",' . "\n";
        $schema.= '"ratingValue": "' . $ratingValue . '",' . "\n";
        $schema.= '"bestRating": "5",' . "\n";
        $schema.= '"worstRating": "1",' . "\n";
        $schema.= '"ratingCount": "' . random_int(700, 1500) . '"' . "\n";
        $schema.= '}' . "\n";
        $schema.= '}' . "\n";
        $schema.= '</script>' . "\n";
        return $schema;
    }
}
if (!function_exists("getCityId")) {
    function getCityId($seo_id) {
        $city = getSingle('seo_master', 'city_id,state_id', ['id' => $seo_id]);
        $city_id = !empty($city['city_id']) ? $city['city_id'] : '';
        $state_id = !empty($city['state_id']) ? $city['state_id'] : '';
        return ['city_id' => $city_id, 'state_id' => $state_id];
    }
}
if (!function_exists("getSubjectName")) {
    function getSubjectName($subject_id) {
        $subject = getSingle('subject_list', 'subject_name', ['id' => $subject_id]);
        $subject_name = !empty($subject['subject_name']) ? $subject['subject_name'] : '';
        return $subject_name;
    }
}
if (!function_exists("getCityName")) {
    function getCityName($city_id) {
        $city = getSingle('city_list', 'city_name', ['id' => $city_id]);
        $city_name = !empty($city['city_name']) ? $city['city_name'] : '';
        return $city_name;
    }
}
if (!function_exists("getClassName")) {
    function getClassName($class_id) {
        $class = getSingle('class_list', 'class_name', ['id' => $class_id]);
        $class_name = !empty($class['class_name']) ? $class['class_name'] : '';
        return $class_name;
    }
}
if (!function_exists("getEmail")) {
    function getEmail($mobile_no) {
        $tutor = getSingle('tutor_list', 'email', ['mobile_no' => $mobile_no]);
        $tutor_email = !empty($tutor['email']) ? $tutor['email'] : '';
        return $tutor_email;
    }
}
if (!function_exists("getStateId")) {
    function getStateId($city_id) {
        $state = getSingle('city_list', 'state_id', ['id' => $city_id]);
        $state_id = !empty($state['state_id']) ? $state['state_id'] : '';
        return $state_id;
    }
}
if (!function_exists("getEmailId")) {
    function getEmailId($id) {
        $tutor = getSingle('tutor_list', 'email', ['id' => $id]);
        $tutor_email = !empty($tutor['email']) ? $tutor['email'] : '';
        return $tutor_email;
    }
}
if (!function_exists("getMultipleClass")) {
    function getMultipleClass($class_ids) {
        $query = 'SELECT GROUP_CONCAT(class_name) as class_names FROM dt_class_list WHERE id IN (' . $class_ids . ')';
        $result = db()->query($query, [$class_ids])->getRowArray();
        $class_names = !empty($result['class_names']) ? $result['class_names'] : '';
        return $class_names;
    }
}
if (!function_exists("getMultipleSubject")) {
    function getMultipleSubject($subject_ids) {
        $query = 'SELECT GROUP_CONCAT(subject_name) as subject_names FROM dt_subject_list WHERE id IN (' . $subject_ids . ')';
        $result = db()->query($query, [$subject_ids])->getRowArray();
        $subject_names = !empty($result['subject_names']) ? $result['subject_names'] : '';
        return $subject_names;
    }
}
if (!function_exists("getMultipleSkill")) {
    function getMultipleSkill($skill_ids) {
        $query = 'SELECT GROUP_CONCAT(skill_name) as skill_names FROM dt_skill_list WHERE id IN (' . $skill_ids . ')';
        $result = db()->query($query, [$skill_ids])->getRowArray();
        $skill_names = !empty($result['skill_names']) ? $result['skill_names'] : '';
        return $skill_names;
    }
}
if (!function_exists("getMultipleBoard")) {
    function getMultipleBoard($board_ids) {
        $query = 'SELECT GROUP_CONCAT(board_name) as board_names FROM dt_boards_list WHERE id IN (' . $board_ids . ')';
        $result = db()->query($query, [$board_ids])->getRowArray();
        $board_names = !empty($result['board_names']) ? $result['board_names'] : '';
        return $board_names;
    }
}
if (!function_exists('tutors_count')) {
    function tutors_count() {
        $session_city=session()->get('session_city');
        $where=[];
        $where['status']='Active';
        $where['kyc_status']='Approved';
        if(!empty($session_city)){
        $where['city']=getCityIdFromName($session_city);
        }
        $count = getSingle('tutor_list', 'count(id) as total', $where);
        return !empty($count['total']) ? $count['total'] : '';
    }
}
if (!function_exists('testimonial_count')) {
    function testimonial_count() {
        $count = getSingle('testimonial_list', 'count(id) as total', ['status' => 'Active']);
        return !empty($count['total']) ? $count['total'] : '';
    }
}
if (!function_exists('tutor_testimonial_count')) {
    function tutor_testimonial_count($tutor_id) {
        $count = getSingle('testimonial_list', 'count(id) as total', ['status' => 'Active','tutor_id'=>$tutor_id]);
        return !empty($count['total']) ? $count['total'] : '';
    }
}
if (!function_exists("getBoardId")) {
    function getBoardId($board_name) {
        $board = getSingle('boards_list', 'id', ['board_name' => $board_name]);
        $board_id = !empty($board['id']) ? $board['id'] : '';
        return $board_id;
    }
}
if (!function_exists('encryptPassword')) {
    function encryptPassword($cookieName, $data, $domain = null) {
        $enc_data = json_encode($data);
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $encryption_iv = '9102407892214621';
        $encryption_key = "281d8febfeee1bdc9ec24c5bb73de622";
        $encryption = openssl_encrypt($enc_data, $ciphering, $encryption_key, 0, $encryption_iv);
        $days = 1365;
        set_cookie($cookieName, $encryption, 60 * 60 * 24 * $days, $domain, '', '', true);
        return $encryption;
    }
}
if (!function_exists("getBoardName")) {
    function getBoardName($board_id) {
        $board = getSingle('boards_list', 'board_name', ['id' => $board_id]);
        $board_name = !empty($board['board_name']) ? $board['board_name'] : '';
        return $board_name;
    }
}
if (!function_exists("getSubjectId")) {
    function getSubjectId($subject_name) {
        $subject = getSingle('subject_list', 'GROUP_CONCAT(id)', ['subject_name' => $subject_name]);
        // echo db()->getLastQuery();exit;
        $subject_id = !empty($subject['GROUP_CONCAT(id)']) ? $subject['GROUP_CONCAT(id)'] : '';
        return $subject_id;
    }
}
if (!function_exists("getClassId")) {
    function getClassId($class_name) {
        $class = getSingle('class_list', 'id', ['class_name' => $class_name]);
        $class_id = !empty($class['id']) ? $class['id'] : '';
        return $class_id;
    }
}
if (!function_exists("getCityIdFromName")) {
    function getCityIdFromName($city_name) {
        $city = getSingle('city_list', 'id', ['city_name' => $city_name]);
        $city_id = !empty($city['id']) ? $city['id'] : '';
        return $city_id;
    }
}
if (!function_exists("getClassGroupId")) {
    function getClassGroupId($class_group_name) {
        $class_group = getSingle('class_group_list', 'id', ['class_group_name' => $class_group_name]);
        $class_group_id = !empty($class_group['id']) ? $class_group['id'] : '';
        return $class_group_id;
    }
}
if (!function_exists("getMultipleClassIds")) {
    function getMultipleClassIds($class_group_id) {
        $class = getSingle('class_list', 'GROUP_CONCAT(id) as ids', ['class_group_id' => $class_group_id]);
        $class_ids = !empty($class['ids']) ? $class['ids'] : '';
        return $class_ids;
    }
}
function getFooterPageList($template_table) {
    $sql = 'SELECT display_name, slug FROM dt_city_area_seo_pages WHERE status=? AND template_table=? AND area_id IS NULL ORDER BY id DESC LIMIT 10';
    $data = db()->query($sql, ['Active', $template_table])->getResultArray();
    return $data;
}
function getListedTutors($class_group_id) {
    $classes = getSingle('class_list', 'GROUP_CONCAT(id) as ids', ['class_group_id' => $class_group_id]);
    $where = [];
    if (!empty($classes)) {
        $class_ids = explode(',', $classes['ids']);
        if (count($class_ids) > 1) {
            $where['class IN (' . $classes['ids'] . ')'] = null;
        } else {
            $where['FIND_IN_SET("' . $classes['ids'] . '", class) >'] = 0;
        }
    }
    $where['status'] = 'Active';
    $where['kyc_status'] = 'Approved';
    $count = getSingle('tutor_list', 'COUNT(id) as total', $where);
    return !empty($count['total']) ? $count['total'] : '';
}
if (!function_exists("getClassGroupIdFromClassId")) {
    function getClassGroupIdFromClassId($class_id) {
        $class_group = getSingle('class_list', 'class_group_id', ['id' => $class_id]);
        $class_group_id = !empty($class_group['class_group_id']) ? $class_group['class_group_id'] : '';
        return $class_group_id;
    }
}
if (!function_exists('current_url')) {
    function current_url():
        string {
            $uri = service('uri');
            return $uri->getScheme() . '://' . $uri->getHost() . $uri->getPath();
        }
    }
if (!function_exists("getCityStateName")) {
    function getCityStateName($city_id) {
    $query = 'SELECT dt_city_list.city_name, dt_state_list.state_name FROM dt_city_list INNER JOIN dt_state_list ON dt_state_list.id = dt_city_list.state_id WHERE dt_city_list.id = '.$city_id;
    $result = db()->query($query)->getRowArray();
    if ($result) {
        return $result['city_name'] . ',' . $result['state_name'];
    } else {
        return false; // or any suitable default value
    }
}

}
if (!function_exists("getQualificationName")) {
    function getQualificationName($qualification_id) {
        $qualification= getSingle('qualification_list', 'qualification_name', ['id' => $qualification_id]);
        $qualification_name = !empty($qualification['qualification_name']) ? $qualification['qualification_name'] : '';
        return $qualification_name;
    }
}
    