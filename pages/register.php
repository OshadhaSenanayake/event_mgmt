<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
	<style> 
	input[type=text], select, input[type=password], input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size:15px;
    font-weight:bold;
	}

	div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    width: 50%;
    align:center;
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
	}

</style>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
	<body background="assets/img/back7.jpg">
	

<div>
  <form action="../server/auth.php" method="POST">
  	<div class="reg"><center>Register &nbsp; Here</center></div>
    <label for="fname"><p>User Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</label>
    <!-- <button style="float:right"type="submit" name="usercheck">Check Availability</button><br> -->
    <input type="text" id="fname" name="username" placeholder="Select you username"> 
    <label for="lname">Full Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </label>
    <input type="text" id="lname" name="fullname" placeholder="Your full name.."> <br>

    <label for="mailaddress">E-Mail Address</label>
    <input type="email" id="lname" name="email" placeholder="Your email Address.."> <br>

    <label for="contactnumber">Contact Number</label>
    <input type="text" id="contactnumber" name="contact" placeholder="Your contact Number.."> <br>

    <label for="city">Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
    <input type="password" id="city" name="pass" placeholder="Your Password" > <br>
    <br>
    <!-- <label for="Registrationtype">Registration Type</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; -->
    <!-- <input type="radio" id="city" name="city">Business User&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; -->
    <!-- <input type="radio" id="city" name="city">Customer<br> -->
    <br>
    <label>&nbsp;</label>
    <input type="submit" value="Sign Up" name="register">
</form>
</div>

</body>
</html>