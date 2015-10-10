<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Travel extends CI_Model {

	public function register($post){
		// INSERT INTO `travel`.`users` (`first_name`, `last_name`, `username`, `password`, `created_at`) VALUES ('Chu', 'Hedgehog', 'chuchu', 'hedgehog', 'NOW()');

		$query = "INSERT INTO users (first_name, last_name, username, password, created_at, updated_at)
		VALUES (?,?,?,?,NOW(),NOW())";
		$values = array($post['first_name'], $post['last_name'], $post['username'], $post['password']);
		$this->db->query($query, $values);
	}
	public function check_id($post){
		// var_dump($post);
		// die('candy');
		$query = "SELECT id, first_name, last_name, username FROM users WHERE username = ? and password =?";
		$values = array($post['username'], $post['password']);
		return $this->db->query($query, $values)->row_array();
	}
	public function new_plan($post){
		// var_dump($post);
		// die('dandy');
		//INSERTING NEW TRIPS
		$query = "INSERT INTO trips (destination, description, start_date, end_date, created_at, updated_at)
		VALUES (?,?,?,?,NOW(),NOW())";
		$values = array($post['destination'], $post['description'], $post['start_date'], $post['end_date']);
		$this->db->query($query, $values);
		$trip_id = $this->db->insert_id();
		// echo $trip_id;
		// die('eclair');
		//INSERTING NEW PLANS
		$query = "INSERT INTO plans (user_id, trip_id) VALUES (?,?)";
		$values = array($post['current_user_id'], $trip_id);
		$this->db->query($query,$values);
	}
	public function fetch_all(){
		$query = "SELECT users.id as user_id, users.first_name, users.last_name, destination, description, start_date, end_date, trips.id as trip_id from plans
		JOIN trips ON plans.trip_id = trips.id
		JOIN users ON plans.user_id = users.id";
		return $this->db->query($query)->result_array();
	}
	public function join($trip_id, $user_id){
		$query = "INSERT INTO plans (user_id, trip_id) VALUES (?,?)";
		$values = array($user_id, $trip_id);
		$this->db->query($query, $values);
	}
	public function display_plan($trip_id)
	{
		$query = "SELECT users.id as user_id, users.first_name, users.last_name, destination, description, start_date, end_date, trips.id as trip_id from plans
		JOIN trips ON plans.trip_id = trips.id
		JOIN users ON plans.user_id = users.id WHERE trips.id = $trip_id";
		return $this->db->query($query)->row_array();
	}
	public function friend_list($trip_id)
	{
		$query = "SELECT users.first_name, users.last_name, users.id FROM plans 
		JOIN users ON plans.user_id = users.id
		WHERE plans.trip_id = $trip_id;";
		return $this->db->query($query)->result_array();
	}
}