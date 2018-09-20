<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alk_user extends CI_Controller {
	public function index()
	{
		if(!$this->session->has_userdata('user')){
			redirect(site_url('login'));
		}

		$sign = $this->general->read('user', array('id' => $this->session->userdata('user')));
		$content['sign'] = $sign['username'];

		$this->load->library('form_validation');
		$this->load->helper('cookie');

		if($this->input->post('add')){
			$validation_conf = array(
					array(
							'field' => 'username',
							'label' => 'Username',
							'rules' => 'required|is_unique[user.username]',
							'errors' => array(
										'required' => 'Nama Pengguna tidak boleh kosong.',
										'is_unique' => 'Nama Pengguna sudah ada.'
								)
						),
					array(
							'field' => 'password',
							'label' => 'Password',
							'rules' => 'required|min_length[5]',
							'errors' => array(
										'required' => 'Password tidak boleh kosong.',
										'min_length' => 'Password minimal 5 digit.'
								)
						)
				);

			$this->form_validation->set_rules($validation_conf);

			if($this->form_validation->run() == true){
				$this->db->insert('user', array(
						'username' => $this->input->post('username'),
						'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
					));
			}else{
				$errors = validation_errors('<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
				set_cookie('errors', $errors, 1);
			}
		}

		if($this->input->post('edit')){
			$is_user = $this->general->read('user', array('id', $this->input->post('id')));
			$is_pass = password_verify($this->input->post('password'), $is_user['password']);
			if($this->input->post('username') != $is_user['username']){
				$this->form_validation->set_rules(
					'username',
					'Username',
					'required|is_unique[user.username]',
					array(
						'required' => 'Nama Pengguna tidak boleh kosong.',
						'is_unique' => 'Nama Pengguna sudah ada.'
					));
			}

			if($this->input->post('last-password')){
				if($is_pass == true){
					$this->form_validation->set_rules(
						'password',
						'Password',
						'required|min_length[5]',
						array(
							'required' => 'Password tidak boleh kosong.',
							'min_length' => 'Password minimal 5 digit.'
						));
				}else{
					set_cookie('errors1', '<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Password lama anda salah.</div>', 1);
				}
			}

			if($this->form_validation->run() == true){
				$this->general->update('user', array(
						'username' => $this->input->post('username'),
						'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
					), 'id', $this->input->post('id'));
			}else{
				$errors = validation_errors('<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
				set_cookie('errors', $errors, 1);
			}
		}

		if($this->input->post('del')){
			$this->db->delete('user', array('id' => $this->input->post('del')));
		}

		if($this->input->post('del-all')){
			$allowed_del = explode(',', $this->input->post('in-del-all'));
			foreach ($allowed_del as $del_item) {
				$this->db->delete('user', array('id' => $del_item));
			}
		}


		$data['errors'] = $this->input->cookie('errors');
		$data['errors1'] = $this->input->cookie('errors1');
		$data['csrf'] = array(
					        'name' => $this->security->get_csrf_token_name(),
					        'hash' => $this->security->get_csrf_hash()
					    );
		$data['user'] = $this->general->read('user');
		$content['content'] = $this->load->view('public/user', $data, true);
		$content['title'] = 'Pengguna - Aplikasi Laporan Keuangan';
		$content['btn'] = 'user';
		$content['btn_add'] = 'btn';
		$content['btn_alink'] = 'tambah-pengguna';
		$this->load->view('layout/alk-template', $content);
		$this->general->reload('pengguna', array('add', 'edit', 'del', 'del-all'));
	}
}