<html>
<?php
$con=mysqli_connect("localhost", "root","","marriot");
if(mysqli_connect_errno()){
	echo 'Failed to connect to MYSQL: '.mysqli_connect_error();
}
?>

<head>
<link type="text/css" rel="stylesheet" href="Stylesheets/logstyle1.css">
</head>

<body>

<h2>Customer Information</h2>

<form id="the form" action="cust_info_page.php" method="POST">
<fieldset>

<p>

<div class="row">
<label for="customername" >Customer Name</label>
<input type="text" id="customername" name="custname"><br><br>
</div>

<div class="row">
<label for="address">Address</label>
<textarea rows="3" col="30" id="address" name="address"></textarea><br><br>
</div>

<div class="row">
<label for="idtype">ID Type</label>
<select id="idtype" name="idtype">
<option value="Aadhar Card">Adhar Card</option>
<option value="Passport">Passport</option>
<option value="Voter ID Card">Voter ID Card</option>
<option value="Driving Liscence">Driving Liscence</option>
</select>

&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

<label for="idnum">ID Number</label>
<input type="text" id="idnum" name="idnum"><br><br>

<label for="numrooms">No. of Rooms</label>
<input type="number" id="numrooms" name="rooms" placeholder="Max=4" size="5">

&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

<label for="numguests">No. of Guests</label>
<input type="number" id="numguests" name="guests" placeholder="Max=7" min="1" max="7">

&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

<label for="numdays">No. of Days</label>
<input type="number" id="numdays" name="days" placeholder="Max=14" min="1" max="14"><br><br>
</div>

<div class="row">
<label for="checkin">Check-In</label>
<input type="date" id="checkin" name="checkin"><br><br>
</div>

<div class="row">
<label for="checkout">Check-Out</label>
<input type="date" id="checkout" name="checkout"><br><br>
</div>

</p>
<!-- <a href="Payment.html" class="button">Submit</a> -->

<input type="submit" value="Submit">

<?php
if(isset($_POST['custname']) && isset($_POST['address']) && isset($_POST['idtype']) && isset($_POST['idnum']) && isset($_POST['rooms']) && isset($_POST['guests']) && isset($_POST['days']) && isset($_POST['checkin']) && isset($_POST['checkout'])) {
	echo 'HOLA';
	$custname=$_POST['custname'];
	$address=$_POST['address'];
	$idtype=$_POST['idtype'];
	$idnum=$_POST['idnum'];
	$rooms=$_POST['rooms'];
	$guests=$_POST['guests'];
	$days=$_POST['days'];
	$checkin=$_POST['checkin'];
	$checkout=$_POST['checkout'];
	
	if(!empty($custname) && !empty($address) && !empty($idtype) && !empty($idnum) && !empty($rooms) && !empty($guests) &&     !empty($days) && !empty($checkin) && !empty($checkout)){
		if($rooms>5) echo 'Maximum 5 rooms can be booked at a time.';
		if($guests>7) echo 'Maximum 7 guests allowed at a time.';
		if($days>14) echo 'Maximum 14 days allowed at a time.';
		$cur_date= date("Y-m-d");
		if(strtotime($checkin) < strtotime($cur_date) ){
			echo 'The checkin time is not permissible.';
			exit();
		}
		$curr_date=strtotime($cur_date);
		if(strtotime($checkout) > strtotime("+14 days", $curr_date)){
			echo 'Please select a feasible checkout time/date';
			exit();
		}

		$query="INSERT INTO cust_info (name, address, id_type, id_number, rooms, guests, days, check_in, check_out) VALUES('$custname', '$address', '$idtype', '$idnum', '$rooms', '$guests', '$days', '$checkin', '$checkout')";
		if(mysqli_query($con,$query)){
			echo 'Insertion Successful.';
		}else{echo 'Insertion unsuccessful. Error: '.$query."<br>".mysqli_error($con);}

	}

	else{
		echo 'Please fill all the fields.';
	}
}else echo 'Not Set';
?>


</fieldset>
</form>
</body>
</html>