<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travels extends CI_Controller {

	public function index()
	{
		if(isset($this->session->userdata['current_user']))
		{
			redirect('dashboard');
		}		
		$this->load->view('index');
	}
	public function dashboard()
	{
		if(!isset($this->session->userdata['current_user']))
		{
			redirect('/');
		}	
		$all_plans = $this->travel->fetch_all();
		$this->load->view('dashboard', array('all_plans' => $all_plans));
	}
		public function register()
	{
		//VALIDATION
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "required|alpha");
		$this->form_validation->set_rules("last_name", "Last Name", "required|alpha");
		$this->form_validation->set_rules("username", "Username", "trim|required|is_unique[users.username]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm_password", "Confirm Password", "required|matches[password]");

		if($this->form_validation->run() === FALSE)
		{
		     $this->view_data["errors"] = validation_errors();
		     $errors = $this->view_data["errors"];
		     $this->session->set_flashdata('messages', $errors);
		}
		//REGISTERATION
		else
		{
			$this->travel->register($this->input->post());
			$no_errors = "<p class='green'>Your registration is complete. You may now log in.</p>";
		    $this->session->set_flashdata('messages', $no_errors);
		}
		redirect("/");
	}
	public function login()
	{
		//VALIDATION
		$this->load->library("form_validation");
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$current_user = ($this->travel->check_id($this->input->post()));
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["errors"] = validation_errors();
			$errors = $this->view_data["errors"];
			$this->session->set_flashdata('messages', $errors);
			redirect('/');
		}
		else if ($current_user == null)
		{
			$errors = "<p class='red'>The email and password you entered don't match.</p>";
			$this->session->set_flashdata('messages', $errors);
		   	redirect('/');
		}
		//LOGIN
		else
		{
			$this->session->set_userdata('current_user', $current_user);
			$this->dashboard();
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
	//ADD PLAN PAGE
	public function add_plan()
	{
		if(!isset($this->session->userdata['current_user']))
		{
			redirect('/');
		}		
		$this->load->view('add_plan');
	}
	public function new_plan()
	{
		$post = $this->input->post();
		$this->session->set_flashdata('post', $post);
		//VALIDATION
		$this->load->library("form_validation");
		$this->form_validation->set_rules('destination', 'Destination', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		// var_dump($this->input->post());
		// die();
		if($this->form_validation->run() === FALSE)
		{
			$this->view_data["errors"] = validation_errors();
			$errors = $this->view_data["errors"];
			$this->session->set_flashdata('messages', $errors);
		}
		elseif(strtotime($this->input->post('start_date')) < strtotime('now'))
		{
			$errors = "<p class='red'>Select a future date.</p>";
			$this->session->set_flashdata('messages', $errors);
		}
		elseif(strtotime($this->input->post('start_date')) > strtotime($this->input->post('end_date')))
		{
			$errors = "<p class='red'>Can't add a date before start date</p>";
			$this->session->set_flashdata('messages', $errors);
		}
		else
		{	
			$this->travel->new_plan($this->input->post());
			$no_errors = "<p class='green'>You successfully added a new plan. Exciting!</p>";
			$this->session->set_flashdata('messages', $no_errors);		
		}
		redirect('add_plan');

	}
	public function destination($trip_id)
	{
		if(!isset($this->session->userdata['current_user']))
		{
			redirect('/');
		}
		$plan_info = $this->travel->display_plan($trip_id);
		$friend_list = $this->travel->friend_list($trip_id);
		$this->load->view('destination', array('plan_info' => $plan_info, 'friend_list' => $friend_list));

	}
	public function join($trip_id, $user_id)
	{
		// echo $trip_id;
		// echo $user_id;
		$this->travel->join($trip_id, $user_id);
		$no_errors = "<p class='green'>You just joined a trip. Exciting!</p>";
		$this->session->set_flashdata('messages', $no_errors);

		redirect('dashboard');

	}


}
