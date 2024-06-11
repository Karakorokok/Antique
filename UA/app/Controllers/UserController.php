<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController {

    public function userHome() {

        return view('user/userhome.php');
    }

    public function userLogin() {

        return view('user/userlogin.php');
    }

    public function userSignup() {
        
        return view('user/usersignup.php');
    }
}
