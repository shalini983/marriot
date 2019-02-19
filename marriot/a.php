<!--<html>
	<body>
		<form action="a.php" method="POST">
		<input type="date" name="d"><br><br>
		<input type="submit" value="Submit">
	    </form>
	</body>	
</html> 
<?php
/*if(isset($_POST['d'])){
$dt=$_POST['d'];
if(!empty($dt)) {
$d=strtotime($dt);
printf("%d\n%d\n",$d,time());
echo strtotime($d);
}
else echo 'enter date';
}*/

//echo date("Y-m-d");


/*echo date("Y-m-d");
echo '\r\n';
$date=date("Y-m-d");
echo strtotime($date);
echo '\r\n';
echo strtotime($date+(24*60*60));*/

  
?>    -->


<!DOCTYPE html>
<html>
<body>

<?php
$startdate=strtotime("Saturday");
$enddate=strtotime("+6 days", $startdate);

while ($startdate < $enddate) {
  echo date("M d", $startdate) . "<br>";
  $startdate = strtotime("+1 day", $startdate);
}
?>
week
</body>
</html>
