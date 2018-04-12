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
	<h2 aight = "center" >Welcome, <?=$_SESSION['sess_user'];?>! <a href = "logout.php">Logout</a></h2>
	</body>
</html>
<?php
}
?>