<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
	}
	public function login_process()
	{
		$this->load->model('user');
		if($this->user->validate_login($this->input->post())==FALSE)
		{
			$this->index();
		}
		else
		{
			$user = $this->user->find_user($this->input->post());
			if($user)
			{
				$this->session->set_userdata('id', $user['id']);
				$this->session->set_userdata('name', $user['name']);
				$this->session->set_userdata('logged_on',1);
				$this->session->set_flashdata('success', 'You have successfully signed in');
				redirect("/wishlists/show/{$user['id']}");
			}
			else
			{
				$this->session->set_flashdata('login_error','Username/Password Combination Does Not Match');
				$this->index();
			}
		}
		$this->session->set_flashdata('login_errors','Username/Password does not match');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
