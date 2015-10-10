<?php
	$current_user = $this->session->userdata('current_user');
	// var_dump($current_user);
	// var_dump($all_plans);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Travel Buddy</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
	       		<li><a href="/logout">Logout</a></li>
	        </ul>
   		</div>
    </nav>
    <div class="row container">
<?php
if($this->session->flashdata('messages'))
{
	echo "<div class='red'>". $this->session->flashdata('messages') ."</div>";
}
?>
    	<h5>Your Trip Schedules</h5>
		<table>
	        <thead>
	        	<tr>
	            	<th>Destination</th>
	            	<th>Travel Start Date</th>
	            	<th>Travel End Date</th>
	            	<th>Plan</th>
	        	</tr>
	        </thead>
	        <tbody>
 <?php
if(count($all_plans) == 0)
{
?>
				<tr>
            		<td>No plans</td>
            	</tr>
<?php
}
else
{
	foreach ($all_plans as $plans)
	{
		if($current_user['id'] == $plans['user_id'])
	 	{
?>

 				<tr>
		            <td><a href="/destination/<?=$plans['trip_id']?>"><?=$plans['destination']?></a></td>
		            <td><?=$plans['start_date']?></td>
		            <td><?=$plans['end_date']?></td>
		            <td><?=$plans['description']?></td>
	        	</tr>
<?php	        
		}
	}
}
 ?>
	<!--         	<tr>
		            <td>Alvin</td>
		            <td>Eclair</td>
		            <td>$0.87</td>
		            <td>$0.87</td>
	        	</tr>
	        	<tr>
		            <td>Alan</td>
		            <td>Jellybean</td>
		            <td>$3.76</td>
		            <td>$3.76</td>
	        	</tr>
	        	<tr>
		            <td>Jonathan</td>
		            <td>Lollipop</td>
		            <td>$7.00</td>
		            <td>$7.00</td>
	        	</tr> -->
	        </tbody>
    	</table>
    	<h5>Other User's Travel Plans</h5>
		<table>
	        <thead>
		        <tr>
		          	<th>Name</th>
		            <th>Destination</th>
		            <th>Travel Start Date</th>
		            <th>Travel End Date</th>
		            <th>Do You Want to Join?</th>
	        	</tr>
	        </thead>
	        <tbody>
<?php 
if(count($all_plans) == 0)
{
?>
				<tr>
            		<td>No plans</td>
            	</tr>
<?php
}
else
{
	if($current_user['id'] != $plans['user_id'])
 	{
?>        
               	<tr>
		            <td><?=$plans['first_name']?> <?=$plans['last_name']?></td>
		            <td><a href="/destination/<?=$plans['trip_id']?>"><?=$plans['destination']?></a></td>
		            <td><?=$plans['start_date']?></td>
		            <td><?=$plans['end_date']?></td>
		            <td><a href="join/<?=$plans['trip_id']?>/<?=$current_user['id']?>">Join</a></td> 
	        	</tr> 
<?php }} ?>	        	    	
	        </tbody>
    	</table>
    </div>
   	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	    <a class="btn-floating btn-large red" href="add_plan">
	    	<i class="large material-icons">add</i>
	    </a>
	</div>
</body>
</html>