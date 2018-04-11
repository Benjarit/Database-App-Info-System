<!DOCTYPE html>
<html>
<body>
<form action="lab5.php" method="POST" >
<tr>
<select name="number">
  <option value="1">Query1</option>
  <option value="2">Query2</option>
  <option value="3">Query3</option>
  <option value="4">Query4</option>
  <option value="5">Query5</option>
  <option value="6">Query6</option>
  <option value="7">Query7</option>
  <option value="8">Query8</option>
</select>
<p></P>
</tr>
<tr>
	<td align = "center"><input type ="submit" value="Go"/> </td>
	<p></P>
</tr>

<?php
	
	$query = $_POST['number'];
	
	// Create connection
	$conn = mysqli_connect('localhost','root','Bigboy3362','research');
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	//queries
	if($query == 1){

		$sql1 = 'CREATE VIEW weight AS SELECT person.pid, person.fname as Firstname, person.lname as Lastname FROM person INNER JOIN body_composition ON person.pid = body_composition.pid WHERE body_composition.weight > 140';
		mysqli_query($conn, $sql1);
		
		$sql2 = 'SELECT * FROM weight';
		$result = mysqli_query($conn, $sql2);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 2){
		
		$sql1 = 'CREATE VIEW BMI AS SELECT weight.Firstname, weight.Lastname, ROUND(703*(body_composition.weight/POWER(body_composition.height,2)),0) as bmi FROM weight INNER JOIN body_composition ON weight.pid = body_composition.pid WHERE body_composition.weight > 150';
		mysqli_query($conn, $sql1);
		
		$sql2 = 'SELECT * FROM BMI';
		$result = mysqli_query($conn, $sql2);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 3){
		
		$sql1 = 'SELECT university_name, city FROM university WHERE EXISTS(SELECT *FROM person WHERE NOT EXISTS(SELECT *FROM person WHERE person.uid = university.uid)) ';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 4){
		$sql1 = 'SELECT person.fname, person.lname FROM person WHERE person.uid IN(SELECT university.uid FROM university WHERE university.city = "Columbia") ';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 5){
		$sql1 = 'SELECT activity_name FROM activity WHERE activity_name NOT IN(SELECT DISTINCT activity_name FROM participated_in)';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 6){
		$sql1 = 'SELECT pid FROM participated_in WHERE activity_name = "running" UNION SELECT pid FROM participated_in WHERE activity_name = "racquetball"';
		$result = mysqli_query($conn, $sql1);
		if(!$result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 7){
		$sql1 = 'SELECT fname, lname FROM person WHERE pid IN(SELECT pid FROM body_composition WHERE age > 30 GROUP BY height HAVING MIN(height) > 65)  ';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 8){
		$sql1 = 'SELECT fname, lname, weight, height, age FROM person INNER JOIN body_composition on person.pid = body_composition.pid ORDER BY body_composition.height DESC, body_composition.weight ASC, person.lname ASC';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	
		echo "<table style='width:50%' align ='center'><tr>";
		
		echo "<tr>";
		while($field_info = mysqli_fetch_field($result)){
			echo "<th align=left>". ($field_info->name) . "</th>";
		}
		echo "</tr>";
		
		 while($row = mysqli_fetch_assoc($result)){
			echo "<tr>";
			foreach($row as $column){
				echo "<td>$column</td>";
			}//end foreach
			echo "</tr>";
		 }//end while	
		echo "</table>";
		 
	mysqli_close($conn);
?>
</form>
</body>
</html>