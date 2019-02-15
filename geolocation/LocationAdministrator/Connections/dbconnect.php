<?
if(!mysql_connect("127.0.0.1","root","gunner1997")) { die('oops connection problem ! --> '.mysql_error()); }
if(!mysql_select_db("geolocate")) { die('oops database selection problem ! --> '.mysql_error()); }
?>
<? 
	$con = mysqli_connect("127.0.0.1", "root", "gunner1997", "geolocate") or die("Error " . mysqli_error($con));
?>