<!DOCTYPE html>
<html>
<body>
<form action="index.php" method="POST" >
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
  <option value="9">Query9</option>
  <option value="10">Query10</option>
  <option value="11">Query11</option>
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
	$conn = mysqli_connect('localhost','root','Bigboy3362','world');
	
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	//queries
	if($query == 1){
		$sql1 = 'SELECT Name, District, Population FROM City WHERE Name = "SpringField" ORDER BY Population DESC';
		
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 2){
		$sql1 = 'SELECT Name, District, Population FROM City WHERE CountryCode = "BRA" ORDER BY Name';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 3){
		$sql1 = 'SELECT Name, Continent, SurfaceArea FROM Country ORDER BY SurfaceArea ASC LIMIT 20';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 4){
		$sql1 = 'SELECT Name, Continent,GovernmentForm, GNP FROM Country WHERE GNP > 200000 ORDER BY Name DESC';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 5){
		$sql1 = 'SELECT Name, LifeExpectancy FROM Country WHERE LifeExpectancy IS NOT NULL ORDER BY Population ASC LITMIT 11 OFFSET 9';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 6){
		$sql1 = 'SELECT Name FROM City WHERE Name LIKE "B%s" ORDER BY Population DESC';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 7){
		$sql1 = 'SELECT  City.Name, Country.Code, City.Population FROM City INNER JOIN Country ON City.CountryCode = Country.Code WHERE City.Population > 6000000 ORDER BY Population DESC';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 8){
		$sql1 = 'SELECT Name, IndepYear, Region FROM Country INNER JOIN CountryLanguage ON Country.Code = CountryLanguage.CountryCode  WHERE CountryLanguage.Language = "English" AND CountryLanguage.IsOfficial = "t" ORDER BY Region ASC, Name ASC';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 9){
		$sql1 = 'SELECT City.Name, City.Population, Country.Population, (City.Population/Country.Population) FROM City INNER JOIN Country ON City.ID = Country.Capital ORDER BY (City.Population/Country.Population) DESC';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 10){
		$sql1 = 'SELECT CountryLanguage.Language, Country.Name, CountryLanguage.Percentage, (Country.Population*((CountryLanguage.Percentage)/100)) FROM CountryLanguage INNER JOIN Country ON CountryLanguage.CountryCode = Country.Code ORDER BY (Country.Population*((CountryLanguage.Percentage)/100)) DESC';
		$result = mysqli_query($conn, $sql1);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}
		$row_cnt = mysqli_num_rows($result);
		printf("Result set has %d rows.<br>", $row_cnt);
	}
	else if($query == 11){
		$sql1 = 'SELECT Name, GNP, GNPOld, (GNP-GNPOld) FROM Country WHERE GNP IS NOT NULL AND GNPOld IS NOT NULL ORDER BY (GNP-GNPOld) DESC';
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
			echo "<th>". ($field_info->name) . "</th>";
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