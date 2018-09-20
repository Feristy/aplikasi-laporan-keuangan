<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alk_pos_akun extends CI_Controller {

	public function index()
	{
		if(!$this->session->has_userdata('user')){
			redirect(site_url('login'));
		}
		
		$sign = $this->general->read('user', array('id' => $this->session->userdata('user')));
		$content['sign'] = $sign['username'];
		$data['pos_akun'] = $this->general->read('post_akun');
		$content['content'] = $this->load->view('public/pos-akun', $data, true);
		$content['btn'] = 'pos-akun';
		$content['title'] = 'Pos Akun - Aplikasi Laporan Keuangan';
		$this->load->view('layout/alk-template', $content);
	}
}