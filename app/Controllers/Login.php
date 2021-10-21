<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MemberModel;
use App\Models\StaffModel;

class Login extends BaseController
{
    public function index()
    {
        //
        echo view("v_login.php");
    }

    public function process()
    {
        $user = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $user->where(['username' => $username])->first();
        if ($data['username'] != "") {
            if ($data['password'] == md5($password)) {
                $userInfo = [];
                if($data['source_id'] != "" && $data['source_table'] != ""){
                    if($data['source_table'] == 'staff'){
                        $staff = new StaffModel();
                        $userInfo = $staff->where(['id'=>$data["source_id"]])->first();
                    }else{
                        $member = new MemberModel();
                        $userInfo = $member->where(['id'=>$data["source_id"]])->first();
                    }
                }
                session()->set([
                    'username' => $data['username'],
                    'user_info' => $userInfo,
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url()."/panel/kanal");
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->to(base_url().'/login');
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->to(base_url().'/login');
        }
    }

    
    function logout()
    {
        session()->destroy();
        return redirect()->to(base_url().'/login');
    }
}
