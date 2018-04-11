<!DOCTYPE html>
<html>
<head>
<style>
#txtbox
{
    font-size:12pt;
    height:31px;
    width:400px;
	border-style: ridge;
    padding-left:15px;
	-webkit-border-radius: 7px;
	background-color: #e5e5e0;
}
caption {
    text-align: left;
    margin-bottom: 1px;
    font-size: 180%;
}
.button {
    background-color: #086a90;
    border: none;
    color: white;
    padding: 10px 23px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	-webkit-border-radius: 7px;
}
input[type=submit]:hover {
	background-color: #135d78;
}
input[type=submit]:active {
	background-color: #0a3a4b;
}
</style>
</head>
		<body>
			<?php
			if($_SERVER["HTTPS"] != "on")
			{
				header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
				exit();
			}
					$conn = mysqli_connect('localhost','root','Bigboy3362','lab8');
					if (!$conn){
						die("Connection failed: " . mysqli_connect_error());
					}
					
							echo "<table style='width:28%' align ='center' cellpadding = '25'>";
							echo "<tr>";
								echo "<caption>". "Create a user or login" . "</caption>" ."<br>";
							echo "</tr>";
							echo "</table>";
							
							echo "<table style='width:30%' align ='center' cellpadding = '6'>";
								echo "<form action='' method='post'>";
								
								echo "<tr>";
									echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='userName' placeholder = 'username' required/></td>";
								echo "</tr>";
								
								echo "<tr>";
									echo "<td><input type='password' style = 'background-color: white;' id='txtbox' name='pw' placeholder = 'password' required/></td>";
								echo "</tr>";
											
								echo "<table style='width:30%' align ='center'>";
								echo "<tr>";
									echo "<td><input class='button' name ='register' type='submit' value='Register'/></td>";
									echo "<td><input class='button' style = 'background-color: #9761b6' name ='login' type='submit' value='Login'/></td>";
								echo "</tr>";
								echo "</table>";	
												
								echo "</form>";
							echo "</table>";
				
							if(isset($_POST['login'])){
							$userDataName = $_POST['userName'];						
							$sql = "SELECT salt, hashed_password, type FROM user WHERE username = ?";
							if ($stmt = mysqli_prepare($conn, $sql)){
								mysqli_stmt_bind_param($stmt, "s", $userDataName) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
								$result = mysqli_stmt_get_result($stmt);
								$row = mysqli_fetch_assoc($result);
								
								if(password_verify($_POST['pw'],$row['hashed_password'])){
									session_start();
									$_SESSION['sess_user'] = $_POST['userName'];
									$_SESSION['sess_userType'] = $row['type'];				
									header("Location: loginPage.php");
								}
								else{
									echo "<table style='width:28%' align ='center' cellpadding = '25'>";
									echo "<tr>";
										echo "<caption>". "Incorrect username or password!" . "</caption>" ."<br>";
									echo "</tr>";
									echo "</table>";
								}
								mysqli_stmt_close($stmt);
							}
						}
							else if(isset($_POST['register'])){
							$userDataName = $_POST['userName'];
							$pwhash = password_hash($_POST['pw'],PASSWORD_DEFAULT,array('cost' => 10));	
							$user = "user";
							$sql = "INSERT INTO user(username,hashed_password,type) VALUES (?,?,?)";
							if($stmt = mysqli_prepare($conn, $sql)){
								mysqli_stmt_bind_param($stmt, "sss", $userDataName,$pwhash,$user) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
								echo "<table style='width:28%' align ='center' cellpadding = '25'>";
								echo "<tr>";
									echo "<caption>". "Success!" . "</caption>" ."<br>";
								echo "</tr>";
								echo "</table>";
								mysqli_stmt_close($stmt);
							}
						}					
					mysqli_close($conn);				
			?>
		</body>
</html>