<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('login');
	}
	public function register_process()
	{
		$this->load->model('user');
		if($this->user->validate_reg($this->input->post())==FALSE)
		{
			$this->index();
		}
		else
		{
			$this->user->insert_user($this->input->post());
			$this->session->set_flashdata('registered', 'You have successfully registered. Please login to continue.');
			redirect('/Users');
		}
	}
}
