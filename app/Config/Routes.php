<?php

namespace Config;

$routes = Services::routes();

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/login', 'Dashboard::login');
$routes->get('/register', 'Dashboard::register');
$routes->post('/register/post', 'Dashboard::postregister');
$routes->post('/login/post', 'Dashboard::postlogin');
$routes->get('/logout', 'Dashboard::logout');

$routes->get('/dashboard/test', 'Dashboard::test');

$routes->get('/dashboard/daftar-produk', 'Dashboard::daftarproduk');
$routes->get('/dashboard/tambah-produk', 'Dashboard::tambahproduk');
$routes->post('/dashboard/tambah-produk', 'Dashboard::posttambahproduk');

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
