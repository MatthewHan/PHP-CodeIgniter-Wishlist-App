<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlists extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_on')!==1)
		{
			redirect('/');
		}
	}
	public function show()
	{
		$this->load->model('wishlist');
		$view_data['user_wishlist'] = $this->wishlist->display_user_wishlist();
		$view_data['wishlist'] = $this->wishlist->display_wishlist();
		$this->load->view('headersignedin');
		$this->load->view('dashboard',$view_data);
	}

	public function show_add_page()
	{
		$this->load->view('headersignedin');
		$this->load->view('additem');
	}

	public function show_product($product_id)
	{
		$this->load->model('wishlist');
		$view_data['product_users'] = $this->wishlist->display_product_users($product_id);
		$view_data['product'] = $this->wishlist->display_product($product_id);
		$this->load->view('headersignedin');
		$this->load->view('product',$view_data);
	}

	public function add_product()
	{
		$this->load->model('wishlist');
		$post = $this->input->post();
		if($this->wishlist->validate_product($post)==FALSE)
		{
			$this->show_add_page();
		}
		else
		{
			$this->wishlist->insert_product($post);
			$product = $this->wishlist->find_product_by_name($post['product_name']);
			$this->wishlist->insert_wishlist($product['id']);
			$this->session->set_flashdata('success','Product successfully added to your wishlist');
			redirect("/dashboard");
		}
	}

	public function add_wishlist($product_id)
	{
		$this->load->model('wishlist');
		$this->wishlist->insert_wishlist($product_id);
		$this->session->set_flashdata('success','Product successfully added to your wishlist');
		redirect("/dashboard");
	}

	public function remove_wishlist($product_id)
	{
		$this->load->model('wishlist');
		$this->wishlist->delete_wishlist($product_id);
		$this->session->set_flashdata('success','Product successfully deleted from your wishlist');
		redirect("/dashboard");
	}

	public function delete_product($product_id)
	{
		$this->load->model('wishlist');
		$this->load->model('wishlist');
		$this->wishlist->delete_product($product_id);
		$this->session->set_flashdata('success','Product successfully deleted from all wishlists, now everyone else who had your item is sad...:(');
		redirect("/dashboard");
	}
}
