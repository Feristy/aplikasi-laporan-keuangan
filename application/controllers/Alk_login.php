<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alk_login extends CI_Controller {

	public function index()
	{
		if($this->session->has_userdata('user')){
			redirect(site_url());
		}

		if($this->input->post('submit')){
			$is_user = $this->general->read('user', array('username' => $this->input->post('username')));
			$is_pass = password_verify($this->input->post('password'), $is_user['password']);
			if(!empty($is_user)){
				if($is_pass == true){
					$this->session->set_userdata('user', $is_user['id']);
					redirect(site_url());
				}else{
					$data['error'] = 'Password salah.';
				}
			}else{
				$data['error'] = 'Username tidak terdaftar.';
			}
		}

		$data['csrf'] = array(
					        'name' => $this->security->get_csrf_token_name(),
					        'hash' => $this->security->get_csrf_hash()
					    );

		$this->load->view('public/login', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect(site_url('login'));
	}
}