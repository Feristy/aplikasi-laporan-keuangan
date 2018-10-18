<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alk_jurnal_umum extends CI_Controller {
	
	public function index()
	{
		if(!$this->session->has_userdata('user')){
			redirect(site_url('login'));
		}

		$sign = $this->general->read('user', array('id' => $this->session->userdata('user')));
		$content['sign'] = $sign['username'];
		
		if($this->input->post('add')){
			$id_debit = 0;
			$id_kredit = 0;

			if($this->input->post('debit')){
				$id_debit = $this->general->last_id('debit', 'id', 1);
				$this->db->insert('debit', array(
					'id' => $id_debit,
					'debit' => $this->input->post('debit'),
					'total' => $this->input->post('total-debit')
					));
			}

			if($this->input->post('kredit')){
				$id_kredit = $this->general->last_id('kredit', 'id', 1);
				$this->db->insert('kredit', array(
					'id' => $id_kredit,
					'kredit' => $this->input->post('kredit'),
					'total' => $this->input->post('total-kredit')
					));
			}

			$this->db->insert('jurnal_umum', array(
					'name' => $this->input->post('name'),
					'id_debit' => $id_debit,
					'id_kredit' => $id_kredit
				));
		}

		if($this->input->post('edit')){
			$edit = $this->general->update('jurnal_umum', array('name' => $this->input->post('name')), 'id', $this->input->post('edit'));

			if((int)$this->input->post('id-debit') != 0){
				$edit1 = $this->general->update('debit', array(
						'debit' => $this->input->post('debit'),
						'total' => $this->input->post('total-debit')
					), 'debit', $this->input->post('debit'));
			}else{
				$edit1 = $this->db->insert('debit', array('debit' => $this->input->post('debit'), 'total' => $this->input->post('total-debit')));
				$edit1 = $this->general->last_id('debit', 'id');

				$edit_jurnal_umum_debit = $this->general->update('jurnal_umum', array('id_debit' => $edit1), 'id', $this->input->post('edit'));
			}

			if((int)$this->input->post('id-kredit') != 0){
				$edit2 = $this->general->update('kredit', array(
						'kredit' => $this->input->post('kredit'),
						'total' => $this->input->post('total-kredit')
					), 'kredit', $this->input->post('kredit'));
			}else{
				$edit2 = $this->db->insert('kredit', array('kredit' => $this->input->post('kredit'), 'total' => $this->input->post('total-kredit')));
				$edit2 = $this->general->last_id('kredit', 'id');

				$edit_jurnal_umum_kredit = $this->general->update('jurnal_umum', array('id_kredit' => $edit2), 'id', $this->input->post('edit'));
			}
		}

		if($this->input->post('add') || $this->input->post('edit')){
			$this->general->total();
		}

		if($this->input->post('del')){
			$this->general->delete($this->input->post('del'));
		}

		if($this->input->post('del-all')){
			$allowed_del = explode(',', $this->input->post('in-del-all'));
			foreach ($allowed_del as $del_item) {
				$this->general->delete($del_item);
			}
		}

		$data['csrf'] = array(
					        'name' => $this->security->get_csrf_token_name(),
					        'hash' => $this->security->get_csrf_hash()
					    );

		$data['jurnal_umum'] = $this->general->read('jurnal_umum');
		$data['pos_akun'] = $this->general->read('post_akun');
		$data['finm'] = $this->general;

		$content['content'] = $this->load->view('public/jurnal-umum', $data, true);
		$content['title'] = 'Jurnal Umum - Aplikasi Laporan Keuangan';
		$content['btn'] = 'jurnal-umum';
		$content['btn_add'] = 'btn';
		$this->load->view('layout/alk-template', $content);
		$this->general->reload('jurnal-umum', array('add', 'edit', 'del', 'del-all'));
	}
}