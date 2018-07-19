<?php

require('../server/server.php');
require('../server/admin.php');
if (!isset ($_SESSION['flag'])){
    header('location:../index.php');
}
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$fullname = $_SESSION['fullname'];
$eventid = $_GET['eventid'];

if($_SESSION['userid'] !=1){
	header('location:../index.php');
}
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

	input[type=submit]:hover {
    background-color: #45a049;
    }

    input[type=submit] {
    width: 100%;
    background-color: #008080;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
	text-align:center;
	}
	
	</style>
</head>
<body onload="onload_events()" background="../assets/img/26.jpg">
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="left" &nbsp; <br>  -->
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="right" &nbsp; <br>  -->
	<b> <h1 id="brand"> <center> Party.lk Administration Dashboard</b> </h1> </center>
	<hr>
	
		<a href=""><input  type="submit" style="width:150px" id="trigger" value = "Manage Events">
		</a><input onclick="set_type('users')" 	type="submit" style="width:150px" id="trigger" value = "Manage Users">
		<input onclick="set_type('supplier')"  type="submit" style="width:150px" id="trigger" value = "Service Providers">
	
    <form action="../server/auth.php" method="POST" class="login">
		<input  style="width:150px;background-color:red;float:right"type="submit" name="logout" value="Logout">
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
		
		<br>
		<h3 >All Events</h3>	
		<br>
		<span style ="font-size:12px;">
		<?php get_event_admin()?>
		</span>
	</div>
	
	<div class="content" style="height:600px">
		<h2><?php
		if (isset($_GET['eventid'])){
			if ($_GET['eventid']!=0){
				include("admin/event.php");
			}
			else{
				include("../pages/overview.php");
			}
		}
		else{
			include("../pages/overview.php");
		}
		
		?>
		</h2>

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
				var user_edit = false;
				var edit_sup = false;	
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
			if (isset($_GET['useredit'])){
			
				echo '<script>
				var user_edit = true;	
				
				</script>';
			}
			if (isset($_GET['edit_sup'])){
			
				echo '<script>
				var edit_sup = true;	
				
				</script>';
			}	
			
	?>


	    <div id ="users" style = "height:400px" class = "newevent">
     Manage Users
	 <?php
	 		echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
            // echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
            echo '<div style="overflow:auto;height:250px;font-size:12px;">';
            get_users_admin($eventid);
            echo '</div>';
        ?>
    
    </div>


	<div id ="supplier" style = "height:450px" class = "newevent">
    	 Manage Service Providers<br>
	 	<?php
	 		echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
			 echo '<a style="" href="../pages/admin.php?eventid='.$eventid.'&edit_sup=venues"><input 
			 style="width:80px;padding:0px;height:25px;"
			 type="submit" value="Venues"></h2></a>';
			 echo '<a style="" href="../pages/admin.php?eventid='.$eventid.'&edit_sup=caterers"><input 
			 style="width:80px;margin-left:10px;padding:0px;height:25px;"
			 type="submit" value="Caterers"></h2></a>';
			 echo '<a style="" href="../pages/admin.php?eventid='.$eventid.'&edit_sup=fooditems"><input 
			 style="width:90px;margin-left:10px;padding:0px;height:25px;"
			 type="submit" value="Food Items"></h2></a>';
			 echo '<a style="" href="../pages/admin.php?eventid='.$eventid.'&edit_sup=av_suppliers"><input 
			 style="width:80px;margin-left:10px;padding:0px;height:25px;"
			 type="submit" value="AV Suppliers"></h2></a>';
			 echo '<a style="" href="../pages/admin.php?eventid='.$eventid.'&edit_sup=photographer"><input 
			 style="width:90px;margin-left:10px;padding:0px;height:25px;"
			 type="submit" value="Photographers"></h2></a>';
			 
            // echo '<a style="float:right" href="../pages/admin.php?eventid='.$eventid.'">[close]</a>';
            echo '<div style="overflow:auto;height:250px;font-size:12px;">';
			// $columnarray = array('venueid','venue_name','');
			if(isset($_GET['edit_sup'])){
				$table = $_GET['edit_sup'];
				get_all($table);
				echo '</div><br>';
				echo 'Add New<br>';
				insert_form($table);
			}
			else{
				get_all('venues');
				echo '</div><br>';
				echo 'Add New<br>';
				insert_form('venues');
			}
		?>
		
		
    
    </div>



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
				if(user_edit == true){
					set_type('users');
				}	
				if(edit_sup == true){
					set_type('supplier');
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