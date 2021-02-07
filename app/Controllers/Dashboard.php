<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\UsersModel;
use Config\Database;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->usermodel = new UsersModel();
        $this->produkmodel = new ProdukModel();
    }

    public function index()
    {
        $users = session('username');
        if (!$users) {
            return redirect()->to('/login');
        } else {
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
        $this->usermodel->save([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => "admin",
        ]);
        return redirect()->to('/login');
    }

    public function postlogin()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cocokuser = $this->usermodel->where('username', $username)->first();
        if ($cocokuser) {
            $cocokpassword = $this->usermodel->where('password', $password)->first();
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
        $produks = $this->produkmodel->findAll();
        return view('admin/daftarproduk', [
            'produks' => $produks
            ]);
    }

    public function tambahproduk()
    {
        return view('admin/tambahproduk');
    }

    public function posttambahproduk()
    {
        $kode_produk = random_int(155555, 555555);
        $gambar = $this->request->getFile('kode_produk');
        $namabaru = $gambar->getRandomName();
        $path = $this->request->getFile('kode_produk')->move('gambar/', $namabaru);
        $this->produkmodel->save([
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga_produk' => strval($this->request->getVar('harga_produk')),
            'gambar_produk' => 'gambar/'.$namabaru,
            'kode_produk' => strval($kode_produk),
        ]);
        return redirect()->to('/dashboard/daftar-produk');
    }

    public function editproduk($id_produk)
    {
        $produk = $this->produkmodel->where('produk_id', $id_produk)->first();
        return view('admin/editproduk', [
            'produk' => $produk
        ]);
    }

    public function posteditproduk($id_produk)
    {
        $kode_produk = random_int(155555, 555555);
        $gambar = $this->request->getFile('kode_produk');
        $namabaru = $gambar->getRandomName();
        $path = $this->request->getFile('kode_produk')->move('gambar/', $namabaru);
        $this->produkmodel->where('produk_id', $id_produk)->set([
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga_produk' => strval($this->request->getVar('harga_produk')),
            'gambar_produk' => 'gambar/'.$namabaru,
            'kode_produk' => strval($kode_produk),
        ])->update();
        return redirect()->to('/dashboard/daftar-produk');
    }

    public function detailproduk($id_produk)
    {
        $produk = $this->produkmodel->where('produk_id', $id_produk)->first();
        return view('admin/detailproduk', [
            'produk' => $produk
        ]);
    }

    public function hapusproduk($id_produk)
    {
        $produk = $this->produkmodel->where('produk_id', $id_produk)->delete();
        return redirect()->to('/dashboard/daftar-produk');
    }

    public function scanner()
    {
        return view('admin/scanner');
    }

    public function resultscanner()
    {
        $resultscanner = $this->request->getVar('qrcode');
        return view('admin/result-scanner', [
            'resultscanner' => $resultscanner
        ]);
    }

    public function test()
    {
        return view('admin/test');
    }
}
