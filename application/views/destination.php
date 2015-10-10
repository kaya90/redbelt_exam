<?php
	$current_user = $this->session->userdata('current_user');
	// var_dump($current_user);
	// var_dump($plan_info);
	// var_dump($friend_list);
?>
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
		?>
    	<div class="col s6">
	      	<div class="row container">
	      		<h5><?=$plan_info['destination']?></h5>
			    <ul>
			    	<li>Planned By: <?=$plan_info['first_name']?> <?=$plan_info['last_name']?></li>
			    	<li>Description: <?=$plan_info['description']?></li>
			    	<li>Travel Date From: <?=$plan_info['start_date']?></li>
			    	<li>Travel Date To: <?=$plan_info['end_date']?></li>
			    </ul>
			    <h5>Other users joining the trip</h5>
			    <ul>
<?php
	foreach($friend_list as $friend)
	{
		if($friend['id'] != $current_user['id'])
		{
?>			    
			    	<li><?=$friend['first_name']?> <?=$friend['last_name']?></li>
<?php
	}
}
?>			    </ul>
			</div>
		</div>
    </div>
</body>
</html>