<?php 
include 'includes/core.inc.php';

$con= mysqli_connect("localhost", "root", "", "marriot");
if(mysqli_connect_errno()){
	echo 'Failed to connect to MYSQL: '.mysqli_connect_error();
}
?>

<html>

<head>
<link type="text/css" rel="stylesheet" href="Stylesheets/logstyle.css">
</head>

<body>

<h2>Please fill the form for your Registeration.</h2>

<form id="theform" action="registration.php"method="POST">
<fieldset>


<p>
<div class="row">
<label for="name">Name</label>
<input type="text" id="name" name="name">
</div><br>

<div class="row">
<label for="dob">DOB</label>
<input type="date" id="dob" name="dob">
</div><br>

<div class="row">
<label for="gender">Gender</label>
<select id="gender" name="gender">
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Others">Others</option>
</select>
</div><br>

<div class="row">
<label for="email">Email</label>
<input type="email" id="email" name="email"><br><br>
</div><br>

<div class="row">
<label for="phone">Phone No.</label>
<input type="tel" id="phone" name="phone"><br><br>
</div><br>

<div class="row">
<label for="username">Username</label>
<input type="text" id="username" name="username"><br><br>
</div><br>

<div class="row">
<label for="password">Password</label>
<input type="password" id="password" name="pass"><br><br>
</div><br>

<div class="row">
<label for="repas">Confirm Password</label>
<input type="password" id="repas" name="repass"><br><br>
</div><br>

<input type="submit" value="Register">
<br><br>

<?php
require 'includes/core.inc.php';

if( isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['repass']) && isset($_POST['name']) && isset($_POST['dob']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['phone']) ) {
    $user=$_POST['username'];
    $pass=$_POST['pass'];
    $repass=$_POST['repass'];
    $name=$_POST['name'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $pass_hash= md5($pass);

    if(!empty($user) && !empty($pass) && !empty($repass) && !empty($phone) && !empty($name) && !empty($dob) && 
    	!empty($gender) && !empty($email)){

    	if($pass!=$repass) echo 'Passwords donot match.';
        else{
        	$query="SELECT username FROM users WHERE username='$user'";
        	$qry_run= mysqli_query($con, $query);
        	if(mysqli_num_rows($qry_run)) echo 'Username '.$user.' already exists.';
        	else{
        		$qry= "INSERT INTO users (username, password, password_hash, name, dob, gender, email, phone) VALUES('$user', '$pass', '$pass_hash', '$name', '$dob', '$gender', '$email', '$phone') ";
        		if($qurey_run= mysqli_query($con, $qry)) {
        			header('Location: loginpage.php');
        		}
        		else echo 'Could not register now. Please try again later.'; 
        	}
        }
    }
    else echo 'All fields are required.';
}

?>
</fieldset>
</form>
</body>
</html>