<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alk_dashboard extends CI_Controller {

	public function index()
	{
		if(!$this->session->has_userdata('user')){
			redirect(site_url('login'));
		}

		$sign = $this->general->read('user', array('id' => $this->session->userdata('user')));
		$content['sign'] = $sign['username'];

		$data['adm'] = $this->general;

		$atime = date('Y-m-d', time());
		$live_time = $this->general->read('traffic', array('date' => $atime));
		$penjualan = $this->general->read('penjualan_bersih', array('name' => 'Penjualan'));
		$diskon_penjualan = $this->general->read('penjualan_bersih', array('name' => 'Diskon Penjualan'));
		$penjualan_bersih = (int)$penjualan['total'] - (int)$diskon_penjualan['total'];

		$t_history_penjualan = $this->db->order_by('id', 'DESC')
										->get_where('traffic_history', array('name' => 'penjualan'))
										->row();

		if(empty($live_time)){
			$t_penjualan = $t_history_penjualan->val != $penjualan_bersih ? $penjualan_bersih: 0;
			$this->db->insert('traffic', array(
					'date' => $atime,
					'name' => 'Penjualan',
					'val' => $t_penjualan
				));
		}elseif(!empty($live_time) && $t_history_penjualan->val != $penjualan_bersih){
			$this->general->update('traffic', array('val' => $penjualan_bersih), 'date', $atime);
		}

		if(empty($t_history_penjualan) || $t_history_penjualan->val != $penjualan_bersih){
			$this->db->insert('traffic_history', array(
					'name' => 'penjualan',
					'val' => $penjualan_bersih,
					'time' => $atime
				));
		}

		$modal = $this->general->read('kewajiban_modal', array('id' => '1'));
		$data['modal'] = $modal['total'];
		$asset = $this->general->read('asset');
		$total_asset = 0;
		foreach ($asset as $value_asset) {
			$total_asset += (int)$value_asset['total'];
		}
		$data['asset'] = $total_asset;

		//laba / rugi bersih
		$biaya = $this->general->read('biaya');
		$total_biaya = 0;
		foreach ($biaya as $value_biaya) {
			$total_biaya += (int)$value_biaya['total'];
		}

		$title_laba = '';
		$laba = 0;

		if($penjualan_bersih > $total_biaya){
			$laba = $penjualan_bersih - $total_biaya;
			$title_laba = 'Laba Bersih';
		}else{
			$laba = $total_biaya - $penjualan_bersih;
			$title_laba = 'Rugi Bersih';
		}

		$data['title_laba'] = $title_laba;
		$data['laba'] = $laba;

		$content['content'] = $this->load->view('public/dashboard', $data, true);
		$content['title'] = 'Dashbord - Aplikasi Laporan Keuangan';
		$content['btn'] = 'home';
		$content['dashboard'] = 'dashboard';
		$this->load->view('layout/alk-template', $content);
	}
}