<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Config\Database;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('admin/index');
    }

    public function login()
    {
        helper(['form']);
        return view('admin/login');
    }

    public function register()
    {
        return view('admin/register');
    }

    public function postregister()
    {
        $userModel = new UsersModel;
        $level = "admin";
        $userModel->save([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => "admin",
        ]);
        return redirect()->to('/login');
    }

    public function postlogin()
    {
        $usermodel = new UsersModel();
        $session = session();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $cocokuser = $usermodel->where('username', $username)->first();
        dd($cocokuser);
        if ($cocokuser) {
            // $cocokpassword = $usermodel->where('password', $password)->first();
            $cocok_password = $cocokuser['password'];
            $password_verify = password_verify($cocok_password, $password);
            if ($password_verify) {
                $setData = [
                    'username' => $username,
                    'password' => $password
                ];
                $session->set($setData);
                return redirect()->to('/dashboard');
            } else {
                return redirect()->to('/login');
            }
        } else {
            return redirect()->to('/login');
        }
    }
}
