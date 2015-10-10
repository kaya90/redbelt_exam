<?php
	$current_user = $this->session->userdata('current_user');
	// var_dump($current_user);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Travel Buddy</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
	<script>
		 $('.datepicker').pickadate({
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 15 // Creates a dropdown of 15 years to control year
		  });
	</script>
	<style type="text/css">
		.red{
			color:white;
		}
		.green{
			color:white;
		}
	</style>
</head>
<body>
	<nav>
    	<div class="nav-wrapper">
	        <ul id="nav-mobile" class="left hide-on-med-and-down">
		        <li><a href="#">Hello, <?=$current_user['first_name']?>!</a></li>
	        </ul>
	        <ul id="nav-mobile" class="right">
	       		<li><a href="/dashboard">Home</a></li>
	       		<li><a href="/logout">Logout</a></li>
	        </ul>
   		</div>
    </nav>
    <div class="row">
			<?php
		if($this->session->flashdata('messages'))
		{
			echo "<div class='red'>". $this->session->flashdata('messages') ."</div>";
		}
		if($this->session->flashdata('post'))
		{
			$post = $this->session->flashdata('post');
		}
		?>
    	<div class="col s6">
	      	<div class="row container">
	      		<h5>Add a Trip</h5>
			    <form method="post" action="new_plan" class="col s12">
			      <div class="row">
			        <div class="input-field col s12">
			          <input id="destination" type="text" class="validate" name="destination" 
			          value="<?php
			          if($this->session->flashdata('post'))
			          {
			          	echo $post['destination'];
			          }
			          ?>">
			          <label for="destination">Destination</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s12">
			          <input id="description" type="text" class="validate" name="description" 
  			          value="<?php
			          if($this->session->flashdata('post'))
			          {
			          	echo $post['description'];
			          }
			          ?>">
			          <label for="description">Description</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s12">
			          <p>Travel Date From</p>
			          <input id="start_date" type="date" class="datepicker" name="start_date" placeholder="Placeholder" 
			          value="<?php
			          if($this->session->flashdata('post'))
			          {
			          	echo $post['start_date'];
			          }
			          ?>">
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s12">
			        	<p>Travel Date To</p>
			          <input id="end_date" type="date" class="datepicker" name="end_date" placeholder="Placeholder"
			          value="<?php
			          if($this->session->flashdata('post'))
			          {
			          	echo $post['start_date'];
			          }
			          ?>">
			        </div>
			      </div>
			      <button type="submit" class="waves-effect waves-light btn">Add</button>
			      <input type="hidden" name="current_user_id" value="<?=$current_user['id']?>">
			    </form>
			</div>
		</div>
    </div>
</body>
</html>