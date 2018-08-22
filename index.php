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
	<body background="assets/img/back4.jpg">
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="left" &nbsp; <br>  -->
	<!-- <img src = "assets/img/3.jpeg" width="180px" height="100px" align ="right" &nbsp; <br>  -->

	<b> <h1> <center> Party.lk </b> </h1> </center>
	<hr>
	<p>
	<center> <b> <h3> |&nbsp;&nbsp;<a style="color:red" href="">Home</a>&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a style="color:red" href="#about">About Us</a>&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a style="color:red" href="#facilities">Facilities</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a style="color:red"  href="#contacts">Contact Us</a>&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |&nbsp;&nbsp;<a style="color:red" href="pages/signup.php">Signup</a>&nbsp;&nbsp;| </h3> </b> </center>
	</p>
	<br>

	<!--a name="top"></a> -->
	<form action="server/auth.php" method="POST" class="login">
		<label><label_heading> <b>Login to your Account</b></label_heading></label><br><br>
		<input name="username" placeholder="Username"> <br><br>
		<input name="pwd" type="password" placeholder="Password"><br><br>
		<button type="submit" name="login">Sign In</button><br>
		<label><label_dev>DEVELOPMENT NOTE: admin login username:admin password:pass</label_dev></label>

	</form>
	
	<hr>

	<!--a name="top"></a> -->

	<div id="home" class = "navigation">
		Home		
    </div>
		<div class= "content">
			<body background="assets/img/back7.jpg"> 
			<h4>WELCOME TO THE ART OF LUXURY MANAGEMENT</h4>
			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<!--p> <h2> Our Service </h2> </p>
			<p> Specializing in the creation of exceptional events for private and corporate clients, not just weddings and events, but creating iconic experiences for our clients and their guests. Through innovative design and flowless execution, we produce memorable and unique events of all shapes, size and style. Our sevents are completely customized and highly professional. From Planning, Photographing, Catering, Audio and Visual supplying we exceed our client expectations and most importantly with intangible element of surprises.  </p>
			<br> -->

			<style type="text/css">
				.pic img{
					width:50px;
				}

			</style>

			<div  >
               <img class="mySlides" src="assets/img/pic8.jpg" style="width:90%">
               <img class="mySlides" src="assets/img/pic7.jpg" style="width:90%">
               <img class="mySlides" src="assets/img/10.jpg" style="width:90%">
               <img class="mySlides" src="assets/img/pic6.jpg" style="width:80%">
               <img class="mySlides" src="assets/img/pic2.jpg" style="width:80%">
            </div>




            <!--script>
            var slideIndex = 1;
		    showDivs(slideIndex);

			function plusDivs(n) {
  				showDivs(slideIndex += n);
            }

			function showDivs(n) {
  				var i;
  				var x = document.getElementsByClassName("mySlides");
  				if (n > x.length) {slideIndex = 1}    
  				if (n < 1) {slideIndex = x.length}
  				for (i = 0; i < x.length; i++) {
     				x[i].style.display = "none";  
                }
 				x[slideIndex-1].style.display = "block";  
            }
		    </script> -->

		    <script>
            var myIndex = 0;
            carousel();

            function carousel() {
              var i;
              var x = document.getElementsByClassName("mySlides");
              for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 3000); // Change image every 3 seconds
            }
            </script>

			<!--h5>Celebrate. Live. Love. Laugh. We look forward to making your next soiree, MEMORABLE</h5> -->

			<!--p> <h2> What we are Covering occations? </h2> </p>
			<img src = "assets/img/8.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/15.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/10.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/16.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/18.jpg" width="300px" height="180px" <br> 
			<img src = "assets/img/17.jpg" width="300px" height="180px" <br> --> 
 		</div> 
 		

 	<hr>
	<div id="about" class = "navigation">
		About Us				
    </div>
		<div class= "content">
			<!--h4>WELCOME TO THE ART OF LUXURY EVENT MANAGEMENT</h4> -->
			<br>
			<p> <h2><u>Our Service</u> </h2> </p>
			<br><br>
			<p> Specializing in the creation of exceptional events for private and corporate clients, not just weddings and events, but creating iconic experiences for our clients and their guests. Through innovative design and flowless execution, we produce memorable and unique events of all shapes, size and style. Our events are completely customized and highly professional. From Planning, Photographing, Catering, Audio and Visual supplying we exceed our client expectations and most importantly with intangible element of surprises.  </p>
			<br>

			<h5 style="font-size:25px;">Celebrate. Live. Love. Laugh. We look forward to making your next soiree, MEMORABLE</h5> 
			<!--p> <h2> Our Vision </h2> </p>
			<p> Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations. </p>
			<p> <h2> Our Mission </h2> </p>
			<p> Party.lk aims to ensure that your special occasions are memorable, unique and stress free. We deliver the highest quality products and services, ensuring that each event we handle far exceeds expectations. </p> -->
 		</div>

 	<hr>
	<div id="facilities" class = "navigation">
		Facilities				
    </div>
		<div class= "content">
			<h2><u> FACILITIES</u></h2> <br> <br>
				 <h6> &nbsp;Photography </h6> 
				
				 <div class= "align">
					<img src = "assets/img/9.jpg" width="700px" height="300px" align="center">
				 </div>
					<br><p>New technology, New techniques and our experties in photographing keep your unforgetable memories as best moments in your life. Well known photographers helping in capturig best moments of your life and we ensure that events are completely cutomized and highly profetional. We are waiting to make your dreams live.</p> <br> 
				 
				 <h6> &nbsp;Catering Services </h6> 
				 
				 <div class="align">
				 	<img src = "assets/img/10.jpg" width="700px" height="300px" align="center">
				 </div>
                    <br><p> New approach to catering through partnerships with iconic award-winning chefs. Allow us to ensure that your special occations and event are more than just an event, but rather a memorable experience and dining adventure that will create lasting memories for you and your guests. And we ensure that each event we handle will exceed your expectation.</p><br>  
				 
				 <h6>&nbsp;Audio Visual Systems </h6> 
				 
				 <div class="align">
				 	<img src = "assets/img/11.jpg" width="700px" height="300px" align="center">
				 </div>
                    <br><p> We ensure to keep your special occasions memorable, unique and stress free. From start to end make your events more enjoyable, elegant and unique experiences to create lasting impress on your guests.  We deliver the highest quality products and services, ensuring that each event exceeds your expectations.</p><br> 
			     
			     <h6> &nbsp;Venue Booking </h6> 
			     
			     <div class="align">
			     	<img src = "assets/img/pic10.jpg" width="700px" height="300px" align="center">
			     </div>
			        <br><p> Convenient and appropriate places keep your events flawless. Ensuring event planning and venue booking are entirely customized per client and can't wait to make your dream days more memorable.</p><br> 
				 
				 <h6> &nbsp;Guest Managing  </h6>

				 <div class="align">
				 	<img src = "assets/img/16.jpg" width="700px" height="300px" align="center">
				 </div>
				    <br><p>Sharing your Happiest, Unforgetable memories with loved ones make your Dreams and Days special. Creating iconic experiences and lovely memories for your guest make your events more special. We ensure to keep your guest more special with our unquie, highly profesional servicers.</p><br> <br> <br>  
 		</div>

 		<hr>
 			<div id="contacts" class = "navigation">
		Contact Us				
    </div>
		<div class= "content">
			<h2><u> Contact Party.lk</u></h2> <br> <br>
			<font size="50px">
				 <p style = "color:#17202A; font-size:40px"> <b>We would love to hear from you!<b></p><br></font>

				 <h5>
				 	 Contact Number -: 011 2456823 <br><br><br>
				 	 Mail address -: party.lk@gmail.com<br><br><br>
				 	 Postal address -: No:4, Galle road, Colombo 3</h5>


				 
		</div>
 	
		
</body>
</html>