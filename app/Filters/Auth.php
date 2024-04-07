<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
class Auth implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        $adminLoginData = session()->get("admin_login_data");
        if (!$adminLoginData) {
            return redirect()->to(base_url(ADMINPATH.'login'));
        }
        
        
    }
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
    }
}
