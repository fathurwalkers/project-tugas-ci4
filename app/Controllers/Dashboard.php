<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('admin/index');
    }

    public function login()
    {
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
        $model = new UsersModel();
        $session = session();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $cocok_user = $model->where('username', $username)->first();
        dd($cocok_user);
        if ($cocok_user) {
            $cocok_password = $model->where('password', $password)->first();
            if ($cocok_password) {
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
