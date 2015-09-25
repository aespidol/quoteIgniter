<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('quote');
	}
	public function index()
	{
		$this->load->view('index');
	}
	public function register()
	{
		$this->form_validation->set_rules('name',"Name", 'required|min_length[3]');
		$this->form_validation->set_rules('username',"username", 'required|is_unique[users.alias]|min_length[3]');
		$this->form_validation->set_rules('email',"email", 'required|is_unique[users.email]|valid_email');
		$this->form_validation->set_rules('password', "required|min_length[8]");
		$this->form_validation->set_rules('confirm_password', "Password", "required|matches[password]");
		$this->form_validation->set_rules('dob', "Date of Birth", "required");


		if($this->form_validation->run() === FALSE)
		{
			 $this->view_data["errors"] = validation_errors();
			 $this->load->view("index", array("errors"=>$this->view_data["errors"]));
		}
		else
		{
			$this->quote->register($this->input->post());
			$this->view_data["success"] = "You have successfully registered";
			$this->load->view("index", array(
				"success"=>$this->view_data["success"]
				));
		}
	}
	public function login()
	{
		$profile = $this->quote->success($this->input->post());
		$this->session->set_userdata('profile', $profile);
		if(count($profile)>0)
		{
			redirect('/quotes/home');
		}
		else
		{
			$this->load->view('index',array('errors'=>"Cannot find user with matching credentials"));
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
	public function home()
	{
		$users = $this->quote->fetch_users();
		$favorite = $this->quote->fetch_favorites();
		$all_quotes = $this->quote->fetch_all_quotes();
		$this->load->view('home', array(
		'profile'=>$this->session->userdata('profile'),
		'all_quotes'=>$all_quotes,
		'favorite' => $favorite,
		'users' => $users
		));		
	}
}
