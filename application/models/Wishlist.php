<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Model {


	public function validate_product($post)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique[products.name]|min_length[3]');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function insert_product($post)
	{
		$query = "INSERT INTO products(name, created_at, updated_at, user_id)
				  VALUES (?,NOW(),NOW(),?)";
		$values = array($post['product_name'],$this->session->userdata('id'));
		$this->db->query($query,$values);
	}

	public function insert_wishlist($product_id)
	{
		$query = "INSERT INTO wishlist(product_id, user_id, created_at,updated_at)
				  VALUES (?,?,NOW(),NOW())";
		$values = array($product_id,$this->session->userdata('id'));
		$this->db->query($query,$values);
	}

	public function find_product_by_name($name)
	{
		$query = "SELECT * FROM products WHERE name = ?";
		$values = array($name);
		return $this->db->query($query,$values)->row_array();
	}


	public function display_user_wishlist()
	{
		$query = "SELECT users.name as add_user, products.name as product_name, wishlist.created_at as date_added, users.id as add_user_id, products.id as product_id
				  FROM wishlist JOIN products on products.id = wishlist.product_id 
				  JOIN users on products.user_id = users.id 
				  WHERE wishlist.user_id = ?
				  ORDER BY wishlist.created_at DESC";
		$values = array($this->session->userdata('id'));
		return $this->db->query($query, $values)->result_array();
	}
	public function display_wishlist()
	{
		$query = "SELECT users.name as add_user, products.name as product_name, wishlist.created_at as date_added, users.id as add_user_id, products.id as product_id
				  FROM wishlist JOIN products on products.id = wishlist.product_id 
				  JOIN users on products.user_id = users.id
				  WHERE users.id != ? AND products.id NOT IN
				  						(SELECT products.id
				  						FROM wishlist JOIN products on products.id = wishlist.product_id
				  						WHERE wishlist.user_id = ?)
				  GROUP BY wishlist.product_id";
		$values = array($this->session->userdata('id'),$this->session->userdata('id'));
		return $this->db->query($query, $values)->result_array();
	}

	public function delete_wishlist($product_id)
	{
		$query = "DELETE FROM wishlist WHERE product_id = ? AND user_id = ?";
		$values = array($product_id, $this->session->userdata('id'));
		$this->db->query($query,$values);
	}

		public function delete_product($product_id)
	{
		$query = "DELETE FROM products WHERE id = ? AND user_id = ?";
		$values = array($product_id, $this->session->userdata('id'));
		$this->db->query($query,$values);
	}

	public function display_product_users($product_id)
	{
		$query = "SELECT users.name
				  FROM wishlist JOIN users on wishlist.user_id = users.id
				  WHERE wishlist.product_id = ?";
		$values = array($product_id);
		return $this->db->query($query, $values)->result_array();
	}
	public function display_product($product_id)
	{
		$query = "SELECT name
				  FROM products
				  WHERE id = ?";
		$values = array($product_id);
		return $this->db->query($query, $values)->row_array();
	}
}
