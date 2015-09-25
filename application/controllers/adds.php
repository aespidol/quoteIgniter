<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adds extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('quote');
	}
	public function home()
	{
		$this->load->view('home', array(
		'profile'=>$this->session->userdata('profile')
		));		
	}
	public function contribute()
	{
		$this->quote->contribute($this->input->post());
		redirect('/quotes/home');
	}
	public function favorite()
	{
		$this->quote->favorite($this->input->post());
		redirect('/quotes/home');
	}
	public function remove()
	{
		$this->quote->delete($this->input->post());
		redirect('/quotes/home');
	}
}
