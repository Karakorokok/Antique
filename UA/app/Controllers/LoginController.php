<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsersAccountModel;

class LoginController extends BaseController
{
    public function index()
    {
        $session = session();
        $session->destroy();
        return view('/login/login');
    }

    public function VerifyLogin()
    {
        $UsersAccountModel = new UsersAccountModel();
        $validation = $this ->validate
        ([ 
            'username' => 
            [
                'rules'=> 'is_not_unique[users_account.username]',
                'errors'=> 
                [
                    'is_not_unique'=>'This Account is not registered!'
                ]
            ],
           
        ]);

        if(!$validation)
        {
            return view('login/login', ['validation' => $this->validator]);
        }
        $Username = $this->request->getPost('username');
        $Password = $this->request->getPost('password');
        $VerifyUser = $UsersAccountModel->VerifyUser($Username,$Password);
        
        if(!$VerifyUser)
        {
            session()->setFlashdata('login-fail', 'Username or Password is incorrect!');
            return redirect()->to('/');
        }
            $userid = $VerifyUser['user_id'];
            $role = $VerifyUser['role'];
            $session = session();
            $session->set('role',$role);
            $session->set('userid',$userid);
            $Last_loggedIn = $VerifyUser['last_login'];
            if($Last_loggedIn == null)
            {
                return redirect()->to('/SetUpAccount');
            }
            else
            {
                $dataLog = ['last_login' => date('Y-m-d-h:i:sa')];
                $UpdateLog = $UsersAccountModel->UpdateRecords($userid,$dataLog);
            }
       
        if($role == '0')
        {
            return redirect()->to('/User/Home');
        }

        else
        {
            return redirect()->to('/admin');
        }
    }

    public function SetupAcc()
    {
        return view('/login/setup');
    }
    public function UpdateAccount()
    {
        $UsersAccountModel = new UsersAccountModel();

        $Username = $this->request->getPost('username');
        $Password = $this->request->getPost('pass');
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $session = session();
        $id = $session->get('userid');
        $data = [
                    'username'=> $Username,
                    'password'=> $hashedPassword,
                    'last_login'=>date('Y-m-d-h:i:sa')
                ];
        $UserAcc = $UsersAccountModel->UpdateRecords($id,$data);
        if(!$UserAcc)
        {   
            session()->setFlashdata('login-fail', 'There are some erorr Seting Up you Account, Please Contact the Admins with Regards to this matter');
            return redirect()->to('/');
        }        
        
        session()->setFlashdata('login-success', 'Account Setup Success, Please Login with your new Credendtials');
        return redirect()->to('/');
    }
    
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }


}
