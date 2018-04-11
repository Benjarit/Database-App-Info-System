<!DOCTYPE html>
<html>
<head>
<style>
#header{
	text-align: left;
	padding:15px;
	font-size:40%;
	padding:12px;
	background-color:white;
	color:black;
	font-family: Arial;
	font-style: normal;
	margin-left:700px;
}
.button {
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
#txtbox
{
    font-size:12pt;
    height:27px;
    width:400px;
	border-style: solid;
    border-color: #11bd50;
    padding-left:15px;
}
#wgtmsr{
	width:343px;   
}

</style>
</head>
	<body>
		<div id="header">
			<h1 style="font-weight:normal;" >
					<form action="success.php" method="post">
						 <p style = "font-weight: bold;">Name</p>
						 <input name = "nameOfCity" type = "text" id="txtbox"/><br>
						 <p style = "font-weight: bold;">District</p>
						 <input name = "district" type = "text" id="txtbox"/><br>
						 <p style = "font-weight: bold;">Population</p>
						 <input name = "population" type = "text" id="txtbox"/><br>
						 <p style = "font-weight: bold;">CountryCode</p>
						 <?php
							$conn = mysqli_connect('localhost','root','Bigboy3362','world2');
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
								$query = 'SELECT Name FROM Country ORDER BY Name ASC';
								$result = mysqli_query($conn, $query);
								if(! $result ){
									die('Could not get data: ' . mysql_error());
								}
								echo "<select name='countryList' id='wgtmsr'>";
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<option value='" . $row['Name'] ."'>" . $row['Name'] ."</option>";
								}
								echo "</select><br><br>";
								mysqli_close($conn);
						?>
						<input class="button" name ="finish" type="submit" value="submit" style="background-color: #11bd50;padding: 10px 180px;"/><br>
						<input class="button" name ="back" formaction="index.php" type="submit" value="Go back to index" style="background-color: #086a90; margin: 30px -250px;"/>
					</form>
			</h1>
		</div>	
	</body>
<html>