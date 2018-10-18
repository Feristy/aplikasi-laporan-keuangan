<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['laporan-keuangan'] = 'Alk_laporan_keuangan';
$route['pos-akun'] = 'Alk_pos_akun';
$route['logout'] = 'Alk_login/logout';
$route['login'] = 'Alk_login';
$route['pengguna'] = 'Alk_user';
$route['history'] = 'Alk_history';
$route['jurnal-umum'] = 'Alk_jurnal_umum';
$route['default_controller'] = 'Alk_dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
