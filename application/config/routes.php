<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['laporan-keuangan'] = 'alk_laporan_keuangan';
$route['pos-akun'] = 'alk_pos_akun';
$route['logout'] = 'alk_login/logout';
$route['login'] = 'alk_login';
$route['pengguna'] = 'alk_user';
$route['history'] = 'alk_history';
$route['jurnal-umum'] = 'alk_jurnal_umum';
$route['default_controller'] = 'alk_dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
