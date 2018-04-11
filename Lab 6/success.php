<!DOCTYPE html>
<html>
<head>
<style>
#header{
	text-align: left;
	background-color:white;
	color:black;
	font-family: Arial;
	font-style: normal;
	margin-left:700px;
}
.button {
	background-color: #086a90;
    color: white;
	border: none;
    padding: 10px 23px;
    text-align: center;
    font-size: 16px;
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
		<div id="header">
		<h1 style="font-weight:normal;" >
				<form action="index.php" method="post">
					<p style = "font-weight: bold; font-size:200%">Success</p>
					<input class="button" name ="goBack" type="submit" value="Back to index"/>
				</form>
		</h1>
		</div>		
		
			<?php
					$conn = mysqli_connect('localhost','root','Bigboy3362','world2');
					if (!$conn) {
						die("Connection failed: " . mysqli_connect_error());
					}
					
					if(isset($_POST["deleteBot"])){
						if($_POST["deleteRole"] == "cityToBeDeleted"){
							$name = $_POST["tempId"];
							$sql = "DELETE FROM City WHERE LOWER(City.Name) = LOWER(?)";
							if ($stmt = mysqli_prepare($conn, $sql)){	
								mysqli_stmt_bind_param($stmt, "s", $name) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
							}
						}
						else if($_POST["deleteRole"] == "countryToBeDeleted"){
							$name = $_POST["tempId"];
							$sql = "DELETE FROM Country WHERE LOWER(Country.Name) = LOWER(?)";
							if ($stmt = mysqli_prepare($conn, $sql)){	
								mysqli_stmt_bind_param($stmt, "s", $name) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
							}
						}
						else if($_POST["deleteRole"] == "languageToBeDeleted"){
							$cCode = $_POST["tempId"];
							$langu = $_POST["tempId2"];
							$sql = "DELETE FROM CountryLanguage WHERE LOWER(CountryLanguage.CountryCode) = LOWER(?) AND LOWER(CountryLanguage.Language) = LOWER(?)";
							if ($stmt = mysqli_prepare($conn, $sql)){	
								mysqli_stmt_bind_param($stmt, "ss", $cCode,$langu) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
							}
						}
					}
					else if(isset($_POST["finish"])){
						$cityName = $_POST["nameOfCity"];
						$cityDistrict = $_POST["district"];
						$cityPopulation = $_POST["population"];
						$countryName = $_POST["countryList"];
						
						$tempSQL = 'SELECT Country.Code From Country WHERE  LOWER(Country.Name) = LOWER(?)'; 
						if ($stmt = mysqli_prepare($conn, $tempSQL)){	
							mysqli_stmt_bind_param($stmt, "s", $countryName) or die("bind param");
							mysqli_stmt_execute($stmt) or die("execute");
							$result = mysqli_stmt_get_result($stmt);
						}
					    $countryCode = mysqli_fetch_assoc($result);
						
						 
						$sql = "INSERT INTO City(Name, CountryCode, District, Population) VALUE (?,?,?,?)";
						if ($stmt = mysqli_prepare($conn, $sql)){	
							mysqli_stmt_bind_param($stmt, "sssi", $cityName,$countryCode['Code'],$cityDistrict,$cityPopulation) or die("bind param");
							mysqli_stmt_execute($stmt) or die("execute");
						}
					}
					else if(isset($_POST["save"])){
						if($_POST["tableName"] == "thisIsCity"){
							$cityId = $_POST["idCity"];
							$dis = $_POST["districtOfCity"];
							$popu = $_POST["pop"];
							
							$sql = "UPDATE City SET City.District = ? , City.Population = ? WHERE City.ID = ?";
							if ($stmt = mysqli_prepare($conn, $sql)){	
								mysqli_stmt_bind_param($stmt, "sii", $dis,$popu,$cityId) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
							}
						}
						else if($_POST["tableName"] == "thisIsCountry"){
							$countryIndepYear = $_POST["inDep"];
							$countryPopulation = $_POST["popu"];
							$countryLocalName = $_POST["localN"];
							$countryGovernmentForm = $_POST["gov"];
							$countryName2 = $_POST["countryName"];
							
							
							$sql = "UPDATE Country SET Country.IndepYear = ? , Country.Population = ? , Country.LocalName = ? , Country.GovernmentForm = ? WHERE Country.Name = ?";
							if ($stmt = mysqli_prepare($conn, $sql)){
								mysqli_stmt_bind_param($stmt, "iisss", $countryIndepYear,$countryPopulation,$countryLocalName,$countryGovernmentForm,$countryName2) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
							}
						}
						else if($_POST["tableName"] == "thisIsLanguage"){
							$languageCountry = $_POST["countCode"];
							$languageThatIsUsed = $_POST["langUsed"];
							$isItOfficial = $_POST["choose"];
							$languagePercentage = $_POST["langPer"];
							
						$sql = "UPDATE CountryLanguage SET CountryLanguage.IsOfficial = ? , CountryLanguage.Percentage = ? WHERE CountryLanguage.CountryCode = ?  AND CountryLanguage.Language = ?";
							if ($stmt = mysqli_prepare($conn, $sql)){
								mysqli_stmt_bind_param($stmt, "ssss", $isItOfficial,$languagePercentage,$languageCountry,$languageThatIsUsed) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
							}	
						}					
					}
					mysqli_close($conn);
			?>	
	</body>
</html>