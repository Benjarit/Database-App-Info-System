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
table{
  border-collapse: collapse;
}
tr{ 
  border: ridge;
  border-width: 1px 0;
}
tr:first-child{
  border-top: none;
}
tr:last-child{
  border-bottom: none;
}
#txtbox
{
    font-size:12pt;
    height:27px;
    width:400px;
	border-style: solid;
    border-color: #4e87d6;
    padding-left:15px;
}
input[type=submit]:hover {
	background-color: #135d78;
}
input[type=submit]:active {
	background-color: #0a3a4b;
}
tr:hover{
    background-color: #eff0f0;
}

caption {
    text-align: left;
    margin-bottom: 1px;
    font-size: 160%;
}
</style>
</head>
	<body>
		<div id="header">
			<h1 style="font-weight:normal;" >
					<form action="" method="post">
						<input name ="text" type = "text" class="mytext" id="txtbox"/>
						<input class="button" name ="submit"  type="submit" value="Go"/>
						<input class="button" name ="submit2" formaction="insert.php" type="submit" value="Insert into city"/><br>
						<input type="radio" name="choose" value="city" checked="checked"/>City
					    <input type="radio" name="choose" value="country"/>Country
					    <input type="radio" name="choose" value="language"/>Language
					</form>
			</h1>
		</div>
	<?php
		$choice = $_POST['choose'];
		
		$conn = mysqli_connect('localhost','root','Bigboy3362','world2');
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		if($choice == "city"){
			$name = "{$_POST['text']}%";
			$sql = "SELECT * FROM City WHERE LOWER(City.Name) LIKE LOWER(?) ORDER BY City.name ASC";
			if ($stmt = mysqli_prepare($conn, $sql)){	
				mysqli_stmt_bind_param($stmt, "s", $name) or die("bind param");
				mysqli_stmt_execute($stmt) or die("execute");
				$result = mysqli_stmt_get_result($stmt);
			}
				echo "<table style='width:50%' align ='center' cellpadding = '25'>";
				echo "<tr>";
					echo "<caption>". "Number of rows: ".mysqli_num_rows($result) . "</caption>" ."<br>";
				echo "</tr>";
				echo "</table>";
		} 
		else if($choice == "country"){
			$name = "{$_POST['text']}%";
			$sql = "SELECT * FROM Country WHERE LOWER(Country.Name) LIKE LOWER(?) ORDER BY Country.name ASC";
			if ($stmt = mysqli_prepare($conn, $sql)){	
				mysqli_stmt_bind_param($stmt, "s", $name) or die("bind param");
				mysqli_stmt_execute($stmt) or die("execute");
				$result = mysqli_stmt_get_result($stmt);
			}	
				echo "<table style='width:50%' align ='center' cellpadding = '25'>";
				echo "<tr>";
					echo "<caption>". "Number of rows: ".mysqli_num_rows($result) . "</caption>" ."<br>";
				echo "</tr>";
				echo "</table>";
		}
		else if($choice == "language"){
			$name = "{$_POST['text']}%";
			$sql = "SELECT * FROM CountryLanguage WHERE LOWER(CountryLanguage.Language) LIKE LOWER(?) ORDER BY CountryLanguage.Language ASC";
			if ($stmt = mysqli_prepare($conn, $sql)){	
				mysqli_stmt_bind_param($stmt, "s", $name) or die("bind param");
				mysqli_stmt_execute($stmt) or die("execute");
				$result = mysqli_stmt_get_result($stmt);
			}	
				echo "<table style='width:50%' align ='center' cellpadding = '25'>";
				echo "<tr>";
					echo "<caption>". "Number of rows: ".mysqli_num_rows($result) . "</caption>" ."<br>";
				echo "</tr>";
				echo "</table>";
		}
				
				echo "<table style='width:50%' align ='center' cellpadding = '25'>";
				echo "<tr>";
				
				echo "<th align=left style='font-size: 20px;'>". "" . "</th>";
				echo "<th align=left style='font-size: 20px;'>". "" . "</th>";
					while($field_info = mysqli_fetch_field($result)){
						echo "<th align=left style='font-size: 20px;'>". ($field_info->name) . "</th>";
					}
				echo "</tr>";
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr>";
					if($_POST["choose"] == "city"){
						echo "<td><form action='edit.php' method='post'><input type='hidden' name='roleData' value='cityToBeUpdated'/><input type='hidden' name='dataOfThatRole' value='".$row["Name"]."'/><input type='submit' name='submitBot' value='Update' class='button' style='background-color: #5486f0;padding: 13px 29px; font-size:15px;'/></form></td>";
						echo "<td><form action='success.php' method='post'><input type='hidden' name='tempId' value='".$row["Name"]."'/><input type='hidden' name='deleteRole' value='cityToBeDeleted'/><input type='submit' name='deleteBot' value='Delete' class='button' style='background-color: #c73626;padding: 13px 29px; font-size:15px;'/></form></td>";
					}
					else if($_POST["choose"] == "country"){
						echo "<td><form action='edit.php' method='post'><input type='hidden' name='roleData' value='countryToBeUpdated'/><input type='hidden' name='dataOfThatRole' value='".$row["Name"]."'/><input type='submit' name='submitBot'  value='Update' class='button' style='background-color: #5486f0;padding: 13px 29px; font-size:15px;'/></form></td>";
						echo "<td><form action='success.php' method='post'><input type='hidden' name='tempId' value='".$row["Name"]."'/><input type='hidden' name='deleteRole' value='countryToBeDeleted'/><input type='submit'  name='deleteBot' value='Delete' class='button' style='background-color: #c73626;padding: 13px 29px; font-size:15px;'/></form></td>";
					}
					else if($_POST["choose"] == "language"){
						echo "<td><form action='edit.php' method='post'><input type='hidden' name='roleData' value='languageToBeUpdated'/><input type='hidden' name='dataOfThatRole' value='".$row["CountryCode"]."'/><input type='hidden' name='dataOfThatRole2' value='".$row["Language"]."'/><input type='submit' name='submitBot' value='Update' class='button' style='background-color: #5486f0;padding: 13px 29px; font-size:15px;'/></form></td>";
						echo "<td><form action='success.php' method='post'><input type='hidden' name='tempId' value='".$row["CountryCode"]."'/><input type='hidden' name='tempId2' value='".$row["Language"]."'/><input type='hidden' name='deleteRole' value='languageToBeDeleted'/><input type='submit' name='deleteBot' value='Delete' class='button' style='background-color: #c73626;padding: 13px 29px; font-size:15px;'/></form></td>";
					}
					
					foreach($row as $column){
						echo "<td>$column</td>";
					}//end foreach
					echo "</tr>";
				}//end while	
				echo "</table>";
		mysqli_close($conn);
	?>
	</body>
</html>