<?php
session_start();
if(!isset($_SESSION["sess_user"])){
	header("Location:index.php");
}else{
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Welcome</title>
	</head>
	<body>
<?php	
	if($_SESSION['sess_userType'] == "user"){
?>
	<h2 aight = "center" >Welcome, <?=$_SESSION['sess_user'];?>! <a href = "logout.php">Logout</a></h2>
<?php	
	}
?>
<?php	
	if($_SESSION['sess_userType'] == "admin"){
?>
	<h2 aight = "center" >Welcome Admin! You have super privileges.<a href = "logout.php">Logout</a></h2>
<?php	
	}
?>
	</body>
</html>
<?php
}
?>