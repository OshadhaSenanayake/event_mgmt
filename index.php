<?php
	require('server/auth.php');
			if (isset($_SESSION['message'])){
				echo '<script>
						alert("'.$_SESSION['message'].'");
						</script>';
				unset($_SESSION['message']);
			}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Party.lk</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
	<body background="assets/img/26.jpg">
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="left" &nbsp; <br>  -->
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="right" &nbsp; <br>  -->
	<b> <h1> <center> Party.lk </b> </h1> </center>
	<hr>
	<center> <b> <h3> |&nbsp;&nbsp;<a href="">Home</a>&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a href="#about">About Us</a>&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a href="#facilities">Facilities</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a href="help">Help</a>&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a href="pages/signup.php">Signup</a>&nbsp;&nbsp;| </h3> </b> </center>
	
	<form action="server/auth.php" method="POST" class="login">
		<label> <b>Login to your Account</label><br></b>
		<input name="username" placeholder="Username"> <br>
		<input name="pwd" type="password" placeholder="Password">
		<button type="submit" name="login">Sign In</button>
		<label>DEVELOPMENT NOTE: admin login username:admin password:pass</label>

	</form>
	
	<hr>

	<div id="home" class = "navigation">
		Home		
    </div>
		<div class= "content">
			<p> <h2> What we Provide you? </h2> </p>
			<p> We are proving a good service to ensure your ..................................... </p>
			<br>

			<p> <h2> What we are Covering occations? </h2> </p>
			<img src = "assets/img/8.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/15.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/10.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/16.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/18.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/17.jpg" width="300px" height="180px" <br> 
 		</div>

 	<hr>
	<div id="about" class = "navigation">
		About Us				
    </div>
		<div class= "content">
			<p> <h2> Our Vision </h2> </p>
			<p> Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations. </p>
			<p> <h2> Our Mission </h2> </p>
			<p> Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations. </p>
 		</div>

 	<hr>
	<div id="facilities" class = "navigation">
		Facilities				
    </div>
		<div class= "content">
			<p> within our web site you can use following facilities. <br> <br>
				<img src = "assets/img/9.jpg" width="300px" height="180px" align="left"> <h2> &nbsp;&nbsp;Photography </h2> &nbsp;&nbsp;Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations. <br> <br> <br> <br> <br> <br> <br>
				<img src = "assets/img/10.jpg" width="300px" height="180px" align="left"> <h2> &nbsp;&nbsp; Catering Services </h2> &nbsp;&nbsp; Photo Graphy. Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations.  <br> <br> <br> <br> <br> <br> <br> 
				<img src = "assets/img/11.jpg" width="300px" height="180px" align="left"> <h2>&nbsp;&nbsp; Audio Visual Systems </h2> &nbsp;&nbsp; Photo Graphy. Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations.<br> <br> <br> <br> <br> <br> <br>
				<img src = "assets/img/13.jpg" width="300px" height="180px" align="left"> <h2> &nbsp;&nbsp; Venue Booking </h2> &nbsp;&nbsp; Photo Graphy. Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations.<br> <br> <br> <br> <br> <br> <br>
				<img src = "assets/img/19.png" width="300px" height="180px" align="left"> <h2> &nbsp;&nbsp;Guest Managing  </h2> &nbsp;&nbsp;Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations.<br> <br> <br> <br> <br> <br> <br>
 		</div>
 	
		
</body>
</html>