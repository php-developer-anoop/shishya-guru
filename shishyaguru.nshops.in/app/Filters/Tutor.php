<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
class Tutor implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        $tutorLoginData = session()->get("tutor_login_data");
        if (!$tutorLoginData) {
            return redirect()->to(base_url(TUTORPATH.'login'));
        }
    }
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    }
}
