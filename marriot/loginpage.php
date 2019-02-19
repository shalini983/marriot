<?php
include 'includes/core.inc.php';

$con= mysqli_connect("localhost", "root", "", "marriot");
if(mysqli_connect_errno()){
	echo 'Failed to connect to MYSQL: '.mysqli_connect_error();
}
?>


<html>

<head>
<link type="text/css" rel="stylesheet" href="Stylesheets/logstyle1.css">
</head>

<body>
<h2> Login Page</h2>
<form id="theform" action="loginpage.php"method="POST">

<p>
<div class="row">
<label for="username">Username</label>
<input type="text" id="username" name="username">
<br><br><br>
</div>

<div class="row">
<label for="password">Password</label>
<input type="password" id="password" name="password">
</div>
</p>
<br>


<?php
if (isset($_POST['username']) && isset($_POST['password'])){
	$user= $_POST['username'];
	$password= $_POST['password'];
	$pass_hash= md5($password);

	if(!empty($user) && !empty($password)){
		$query= "SELECT id FROM users WHERE username='$user' AND password_hash='$pass_hash'";
	$query_run = mysqli_query($con,$query);
	$qry_rows = mysqli_num_rows($query_run);
	if($qry_rows==0)
		echo 'Invalid Username/Password.';
	else if ($qry_rows==1){
		$user_id= mysql_result($query_run, 0, 'id');
		$_SESSION['user_id']= $user_id;
		header('location:Login Confirmation Page.html');
	}
	}
	else{
		echo'You must enter a username and password';
	}
}

mysqli_close($con);

?>

<p><br><br>
<button type="submit" value ="submit">Log-In</button>
</p>

</form>
</body>
</html>