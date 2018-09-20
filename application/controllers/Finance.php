<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('time', 'paging'));
		$this->load->model('finance_model');
		$this->time->default_timezone('Asia/Jakarta');
	}

	public function index(){

		$data['adm'] = $this->finance_model;

		$atime = date('Y-m-d', time());
		$live_time = $this->finance_model->read('wapp_traffic', array('date' => $atime));

		$penjualan = $this->finance_model->read('wapp_penjualan_bersih', array('name' => 'Penjualan'));
		$diskon_penjualan = $this->finance_model->read('wapp_penjualan_bersih', array('name' => 'Diskon Penjualan'));
		$penjualan_bersih = (int)$penjualan['total'] - (int)$diskon_penjualan['total'];

		if(empty($live_time)){
			$this->db->insert('wapp_traffic', array(
				'date' => $atime,
				'name' => 'Penjualan',
				'val' => $penjualan_bersih
			));
		}elseif($live_time['val'] != $penjualan_bersih){
			$this->db->insert('wapp_traffic', array(
				'date' => $atime,
				'name' => 'Penjualan',
				'val' => $penjualan_bersih
			));
		}

		$modal = $this->finance_model->read('wapp_modal', array('id' => '1'));
		$data['modal'] = (int)$modal;
		$asset = $this->finance_model->read('wapp_asset');
		$total_asset = 0;
		foreach ($asset as $value_asset) {
			$total_asset += (int)$value_asset['total'];
		}
		$data['asset'] = $total_asset;

		//laba / rugi bersih
		$biaya = $this->finance_model->read('wapp_biaya');
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

		$this->load->view('finance/header', $data);
		$this->load->view('finance/index');
		$this->load->view('finance/footer');
	}

	public function all_data(){
		$id_debit = 0;
		$id_kredit = 0;

		if($this->input->post('add')){
			if($this->input->post('debit')){
				$this->db->insert('wapp_debit', array(
					'debit' => $this->input->post('debit'),
					'total' => $this->input->post('total-debit')
					));

				$id_debit = $this->finance_model->read('wapp_debit');
				foreach ($id_debit as $value_id_debit) {
					$id_debit = $value_id_debit['id'];
				}
			}

			if($this->input->post('kredit')){
				$this->db->insert('wapp_kredit', array(
					'kredit' => $this->input->post('kredit'),
					'total' => $this->input->post('total-kredit')
					));

				$id_kredit = $this->finance_model->read('wapp_kredit');
				foreach ($id_kredit as $value_id_kredit) {
					$id_kredit = $value_id_kredit['id'];
				}
			}

			$this->db->insert('wapp_jurnal_umum', array(
					'name' => $this->input->post('name'),
					'id_debit' => $id_debit,
					'id_kredit' => $id_kredit
				));
		}

		if($this->input->post('edit')){
			$edit = $this->finance_model->update('wapp_jurnal_umum',
				array('name' => $this->input->post('name')),
				'id',
				$this->input->post('edit'));

			if((int)$this->input->post('id-debit') != 0){
				$edit1 = $this->finance_model->update('wapp_debit', array(
						'debit' => $this->input->post('debit'),
						'total' => $this->input->post('total-debit')
					), 'debit', $this->input->post('debit'));
			}else{
				$edit1 = $this->db->insert('wapp_debit', array('debit' => $this->input->post('debit'), 'total' => $this->input->post('total-debit')));
				$edit1 = $this->finance_model->read('wapp_debit');
				foreach ($edit1 as $value_edit1) {
					$edit1 = $value_edit1['id'];
				}

				$edit_jurnal_umum_debit = $this->finance_model->update('wapp_jurnal_umum', array('id_debit' => $edit1), 'id', $this->input->post('edit'));
			}

			if((int)$this->input->post('id-kredit') != 0){
				$edit2 = $this->finance_model->update('wapp_kredit', array(
						'kredit' => $this->input->post('kredit'),
						'total' => $this->input->post('total-kredit')
					), 'kredit', $this->input->post('kredit'));
			}else{
				$edit2 = $this->db->insert('wapp_kredit', array('kredit' => $this->input->post('kredit'), 'total' => $this->input->post('total-kredit')));
				$edit2 = $this->finance_model->read('wapp_kredit');
				foreach ($edit2 as $value_edit2) {
					$edit2 = $value_edit2['id'];
				}

				$edit_jurnal_umum_kredit = $this->finance_model->update('wapp_jurnal_umum', array('id_kredit' => $edit2), 'id', $this->input->post('edit'));
			}
		}

		if($this->input->post('add') || $this->input->post('edit')){
			$this->finance_model->total();
		}

		if($this->input->post('del')){
			$this->finance_model->delete($this->input->post('del'));
		}

		if($this->input->get('search')){
			$page = !empty($_GET['p']) ? '&p='.$_GET['p']: '';
			redirect(site_url('jurnal-umum'.'?s='.$this->input->get('search').$page));
		}

		if($this->input->get('s')){
			$data['jurnal_umum'] = $this->paging->set_public_paging('wapp_jurnal_umum', 1, 'name', $this->input->get('s'));
		}else{
			$data['jurnal_umum'] = $this->paging->set_public_paging('wapp_jurnal_umum', 1);
		}

		$data['pos_akun'] = $this->finance_model->read('wapp_post_akun');
		$data['finm'] = $this->finance_model;
		$data['input'] = $this->input;
		$data['paging'] = $this->paging;

		$this->load->view('finance/header', $data);
		$this->load->view('finance/jurnal-umum');
		$this->load->view('finance/footer');

		if($this->input->post('add') || $this->input->post('edit') || $this->input->post('del') || $this->input->post('del-all')){
			redirect(site_url('jurnal-umum'));
		}
	}
}