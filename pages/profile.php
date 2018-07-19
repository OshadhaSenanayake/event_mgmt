<?php

require('../server/server.php');
if (!isset ($_SESSION['flag'])){
    header('location:../index.php');
}

$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$fullname = $_SESSION['fullname'];


?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $fullname;?></title>
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
	<style>
	.form select {
		width:300px;
		margin-top:10px;
		
	}
	.label{
		width: 300px;
		height:120px;
		font-size: 13px;
		display: block;
		padding: 5px;
		float: left;
		margin: 10px;
	}
	
	button{
		border-radius: 5px;
		background-color: blue;
		color:white;
		font-weight: bold;
		height: 50px;
	}
	
	</style>
</head>
<body onload="onload_events()" background="../assets/img/26.jpg">
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="left" &nbsp; <br>  -->
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="right" &nbsp; <br>  -->
	<b> <h1 id="brand"> <center> Party.lk Event Management and Party Planning System</b> </h1> </center>
	<hr>
	
    <form action="../server/auth.php" method="POST" class="login">
        <label> <?php echo $fullname;?></label>
		<button style="height:30px;"type="submit" name="logout">Logout</button>

		<?php
			if (isset($_SESSION['message'])){
				echo '<script>
						alert("'.$_SESSION['message'].'");
						</script>';
				unset($_SESSION['message']);
			}
		?>
	</form>

	<hr>

	<div id="home" class = "sidebar" style="height:600px;">
		<button style="width:150px;background-color:green" id="trigger">Create New Event</button>
		<br>
		<h3>Select Your Event</h3>	
		<br><?php get_event($username)?>
	</div>
	
	<div class="content" style="height:600px">
		<h2><?php
		if (isset($_GET['eventid'])){
			include("../pages/event.php");
		}
		else{
			include("../pages/overview.php");
		}
		
		?>
		</h2>

	</div>

	<div id="modal" class="newevent">
	
		<h1 style="margin-bottom: 0%">Create Party: General Information</h1><br>
		<form id="step1" action="../pages/profile.php" class="newevent_form" method="POST">
			<label>Event Name</label>
			
			<input type="text" id="event_name" name="event_name" >
			<label>Date</label>
			<input type="date" id="event_date" name="event_date" ><br>
			<label>From</label>
			<input type="time" id="event_start" name="event_start" ><br>
			<label>To</label>
			<input type="time" id="event_to" name="event_to" ><br><br>
			<label>Nearest City</label>
			<input type="text" id="event_city" name="event_city" >
			<input type="hidden" name="step1" value="set">
			<button type="submit" name="step1">Next</button>
			<a href="../pages/profile.php">[close]</a>
		</form>
	</div>
	<br>

	<?php
	if (isset($_POST['step1'])){
		$var = array();
		// $var[0]=$_POST['event_name'];
		$var['event_name']= $_POST['event_name'];
		$var['event_date'] = $_POST['event_date'];
		$var['event_start'] =  $_POST['event_start'];
		$var['event_to'] = $_POST['event_to'];
		$var['event_city'] = $_POST['event_city'];
	}
	?>


	<div id="modal2" class="newevent">
		<h1 style="margin-bottom: 0%">Step 2: Add Services</h1><br>
		
		<center>
			You can change these information later.
		</center>
		<?php
			// print_r($var);
			echo '<h3>'.$var['event_name'].'</h3><br>';
			echo $var['event_date'];
			?>
		<form class="form" action="../server/server.php" method="POST" style="font-size: 15px;">
		<div class="label"><b>Venue</b><br>
			Select one out of the available venues. 
			Select <b>Custom Venue</b> for own venue.
			<select name="event_venue">
				<option value="custom">Custom Venue</option>
			<?php gen_list("venues");?>
			</select>
		</div>

		<div class="label"><b>Catering</b><br>
			Select Your Preferred Caterer. You can view their menus later and arrange your meals.
			<select name="event_cater">
				<option value="none">No Thank You!</option>
				<?php gen_list("caterers");?>
			</select>
		</div>

		<div class="label"><b>Photography</b><br>
			Select Your Event Coverage service provider. Rates are per hour.
			<select name="event_photo">
				<option value="none">No Thank You!</option>
				<?php gen_list("photographer");?>
			</select>
		</div><br>
		
		<div class="label"><b>Audio Visual System</b><br>
			Select your AV facilities provider. Customize your order later in the dashboard.
			<select name="event_av">
				<option value="none">No Thank You!</option>
				<?php gen_list("av_suppliers");?>
			</select>
		</div><br>
		<?php 
			if(isset($var)){

				echo count($var);
				$key=array_keys($var);
				for ($i=0; $i< count($var);$i++){
					echo '<input type="hidden" name="'.$key[$i].'" value="'.$var[$key[$i]]. '" >';
				}
			}
		?>
		<button name="new_complete" type="submit">Finish</button>
		<a href="../pages/profile.php">[close]</a>
		</form>
	</div>
	






	<footer>Party.lk All rights reserved &copy 2018</footer>
	
 <!-- Php Generated JS -->
			<script>
				var guest_modal = false;
				var food_modal = false;
				var budget_modal = false;
			</script>
	<?php
			if (isset($_POST['step1'])){

				echo '<script>
				modal2.style.display="block";
				modal2.style.opacity="1";	
				</script>';
			}
			if (isset($_GET['guest_edit'])){
			
				echo '<script>
				var guest_modal = true;	
		
				</script>';
			}
			if (isset($_GET['food_edit'])){
			
				echo '<script>
				var food_modal = true;	
				
				</script>';
			}
			if (isset($_GET['budget'])){
			
				echo '<script>
				var budget_modal = true;	
				
				</script>';
			}
	?>

<!-- Scripts -->
<script>
			
			var modal = document.getElementById('modal');
			var trigger = document.getElementById("trigger");
			var message = document.getElementById("message");
			trigger.onclick = function(){
			
				modal.style.display="block";
				modal.style.opacity="1";
			}
			function onload_events(){
				if(guest_modal==true){
					// alert('echo');
					set_type('edit_guests');
				}
				if(food_modal==true){
					// alert('echo');
					set_type('food_list');
				}
				if(budget_modal==true){
					// alert('echo');
					set_type('budget');
				}
			}
			function set_type(table){
				// alert(table);
				edit_modal = document.getElementById(table);
				edit_modal.style.display="block";
				edit_modal.style.opacity="1";
			}
			
</script>
		
</body>
</html>