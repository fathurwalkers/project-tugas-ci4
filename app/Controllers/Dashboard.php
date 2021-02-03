<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Config\Database;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->usermodel = new UsersModel();
    }

    public function index()
    {
        $users = session('username');
        if (!$users){
            return redirect()->to('/login');
        }else{
            return view('admin/index', ['users' => $users]);
        }
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

    public function logout()
    {
        $session = session();
        $session->stop();
        return redirect()->to('/login');
    }

    public function postregister()
    {
        // $userModel = new UsersModel;
        $level = "admin";
        $this->usermodel->save([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => "admin",
        ]);
        return redirect()->to('/login');
    }

    public function postlogin()
    {
        // $this->usermodel = new UsersModel();
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cocokuser = $this->usermodel->where('username', $username)->first();
        // dd($cocokuser);
        if ($cocokuser) {
            $cocokpassword = $this->usermodel->where('password', $password)->first();
            // $cocok_password = $cocokuser['password'];
            // $password_verify = password_verify($password, $cocok_password);
            if ($cocokpassword) {
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
        return redirect()->to('/login');
    }

    public function daftarproduk()
    {
        return view('admin/daftarproduk');
    }

    public function test()
    {
        return view('admin/test');
    }
}
