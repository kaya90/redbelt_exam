<!DOCTYPE html>
<html>
<head>
	<title>Travel Buddy</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
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
		        <li><a href="#">Welcome!</a></li>
	        </ul>
   		</div>
    </nav>
    <div class="row">
			<?php
		if($this->session->flashdata('messages'))
		{
			echo "<div class='red'>". $this->session->flashdata('messages') ."</div>";
		}
		?>
    	<div class="col s6">
	      	<div class="row container">
			    <form method="post" action="register" class="col s12">
			      <div class="row">
			        <div class="input-field col s6">
			          <input id="first_name" type="text" class="validate" name="first_name">
			          <label for="first_name">First Name</label>
			        </div>
			        <div class="input-field col s6">
			          <input id="last_name" type="text" class="validate" name="last_name">
			          <label for="last_name">Last Name</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s12">
			          <input id="username" type="text" class="validate" name="username">
			          <label for="username">Username</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s12">
			          <input id="password" type="password" class="validate" name="password">
			          <label for="password">Password (Password should be at least 8 characters)</label>
			        </div>
			      </div>
			      <div class="row">
			        <div class="input-field col s12">
			          <input id="confirm_password" type="password" class="validate" name="confirm_password">
			          <label for="confirm_password">Confirm Password</label>
			        </div>
			      </div>
			      <button type="submit" class="waves-effect waves-light btn">Register</button>
			    </form>
			</div>
		</div>
	    <div class="col s6">
	    	<div class="row container">
	    		<form method="post" action="login">
					<div class="row">
				        <div class="input-field col s12">
				          <input id="username" type="text" class="validate" name="username">
				          <label for="username">Username</label>
				        </div>
				    </div>
				    <div class="row">
				        <div class="input-field col s12">
				          <input id="password" type="password" class="validate" name="password">
				          <label for="password">Password</label>
				        </div>
				    </div>
				    <button type="submit" class="waves-effect waves-light btn">Login</button>
	    		</form>
			</div>
     	</div>
    </div>
</body>
</html>