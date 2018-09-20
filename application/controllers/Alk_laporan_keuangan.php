<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alk_laporan_keuangan extends CI_Controller {

	public function index()
	{
		if(!$this->session->has_userdata('user')){
			redirect(site_url('login'));
		}
		
		$sign = $this->general->read('user', array('id' => $this->session->userdata('user')));
		$content['sign'] = $sign['username'];
		$data['asset'] = $this->general->read('asset');
		$data['biaya'] = $this->general->read('biaya');
		$data['penjualan_bersih'] = $this->general->read('penjualan_bersih');
		$data['modal'] = $this->general->read('modal');
		$data['kewajiban_modal'] = $this->general->read('kewajiban_modal');
		$content['content'] = $this->load->view('public/laporan-keuangan', $data, true);
		$content['btn'] = 'laporan-keuangan';
		$content['title'] = 'Laporan Keuangan - Aplikasi Laporan Keuangan';
		$this->load->view('layout/alk-template', $content);
	}
}