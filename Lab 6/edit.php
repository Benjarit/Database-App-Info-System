<!DOCTYPE html>
<html>
<head>
<style>
#txtbox
{
    font-size:12pt;
    height:31px;
    width:1000px;
	border-style: ridge;
    padding-left:15px;
	-webkit-border-radius: 7px;
	background-color: #e5e5e0;
}
caption {
    text-align: left;
    margin-bottom: 1px;
    font-size: 160%;
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
					$conn = mysqli_connect('localhost','root','Bigboy3362','world2');
					if (!$conn) {
						die("Connection failed: " . mysqli_connect_error());
					}
							
					if(isset($_POST["submitBot"])){
						if($_POST["roleData"] == "cityToBeUpdated"){							
							$nameOfCity = $_POST["dataOfThatRole"];
							$sql = 'SELECT * FROM City WHERE LOWER(City.Name) = LOWER(?)';
							if ($stmt = mysqli_prepare($conn, $sql)){	
								mysqli_stmt_bind_param($stmt, "s", $nameOfCity) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
								$result = mysqli_stmt_get_result($stmt);
							}	
							$cityId = mysqli_fetch_assoc($result);
							echo "<table style='width:50%' align ='center' cellpadding = '25'>";
							echo "<tr>";
								echo "<caption>". "Update record from the City table..." . "</caption>" ."<br>";
							echo "</tr>";
							echo "</table>";
							
							echo "<table style='width:50%' align ='center' cellpadding = '6'>";
								echo "<form action='success.php' method='post'>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> ID </td>";
								echo "</tr>";
								
								echo "<td><input type='text' id='txtbox' name='idCity' value='" . $cityId["ID"] . "' readonly/></td>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> Name </td>";
								echo "</tr>";
								
								echo "<td><input type='text' id='txtbox' name='cityName' value='" . $cityId["Name"] . "' readonly/></td>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> CountryCode </td>";
								echo "</tr>";
								
								echo "<td><input type='text' id='txtbox' name='codeOfCountry' value='" . $cityId["CountryCode"] . "' readonly/></td>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> District </td>";
								echo "</tr>";
								
								echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='districtOfCity' value='" . $cityId["District"] . "' required/></td>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> Population </td>";
								echo "</tr>";
								
								echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='pop' value='" . $cityId["Population"] . "' required/></td>";
								
	
								echo "<td><input type='hidden' name='tableName' value='thisIsCity'/></td>";				
								echo "<tr>";
									echo "<td><input class='button' name ='save' type='submit' value='Save'/></td>";
								echo "</tr>";	
								
								
								echo "</form>";
							echo "</table>";				
						}
						else if($_POST["roleData"] == "countryToBeUpdated"){
							$nameOfCountry = $_POST["dataOfThatRole"];
							$sql = 'SELECT * FROM Country WHERE LOWER(Country.Name) = LOWER(?)';
							if ($stmt = mysqli_prepare($conn, $sql)){	
								mysqli_stmt_bind_param($stmt, "s", $nameOfCountry) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
								$result = mysqli_stmt_get_result($stmt);
							}	
							$countryId = mysqli_fetch_assoc($result);
							
							
							echo "<table style='width:50%' align ='center' cellpadding = '25'>";
							echo "<tr>";
								echo "<caption>" . "Update record from the Country table..." . "</caption>" ."<br>";
							echo "</tr>";
							echo "</table>";
							
							echo "<table style='width:50%' align ='center' cellpadding = '6'>";
								echo "<form action='success.php' method='post'>";
					
							while($field_info = mysqli_fetch_field($result)){
								if((($field_info->name) != "IndepYear" && ($field_info->name) != "Population") && (($field_info->name) != "LocalName" && ($field_info->name) != "GovernmentForm") && ($field_info->name) != "Name"){
									echo "<tr>";
										echo "<td style = 'font-weight: bold; font-size:100%'>". ($field_info->name) ."</td>";
									echo "</tr>";
									echo "<td><input type='text' id='txtbox' name='idCountry' value='" . $countryId[($field_info->name)] . "' readonly/></td>";
								}
								else if(($field_info->name) == "Name"){
									echo "<tr>";
										echo "<td style = 'font-weight: bold; font-size:100%'> Name </td>";
									echo "</tr>";
									echo "<td><input type='text' id='txtbox' name='countryName' value='" . $countryId["Name"]  . "' readonly/></td>";
								}
								else if(($field_info->name) == "IndepYear"){
									echo "<tr>";
										echo "<td style = 'font-weight: bold; font-size:100%'> IndepYear </td>";
									echo "</tr>";
									echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='inDep' value='" . $countryId["IndepYear"]  . "' required/></td>";
								}
								else if(($field_info->name) == "Population"){
									echo "<tr>";
										echo "<td style = 'font-weight: bold; font-size:100%'> Population </td>";
									echo "</tr>";
									echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='popu' value='" . $countryId["Population"]  . "' required/></td>";
								}
								else if(($field_info->name) == "LocalName"){
									echo "<tr>";
										echo "<td style = 'font-weight: bold; font-size:100%'> LocalName </td>";
									echo "</tr>";
									echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='localN' value='" . $countryId["LocalName"]  . "' required/></td>";
								}
								else if(($field_info->name) == "GovernmentForm"){
									echo "<tr>";
										echo "<td style = 'font-weight: bold; font-size:100%'> GovernmentForm </td>";
									echo "</tr>";
									echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='gov' value='" . $countryId["GovernmentForm"]  . "' required/></td>";
								}
							}									
								echo "<td><input type='hidden' name='tableName' value='thisIsCountry'/></td>";
								echo "<tr>";	
									echo "<td><input class='button' name ='save' type='submit' value='Save'/></td>";
								echo "</tr>";
								
								echo "</form>";
							echo "</table>";							
						}
						
						else if($_POST["roleData"] == "languageToBeUpdated"){
							$countryThatUse = $_POST["dataOfThatRole"];
							$langua = $_POST["dataOfThatRole2"];
							
							$sql = 'SELECT * FROM CountryLanguage WHERE LOWER(CountryLanguage.CountryCode) = LOWER(?) AND LOWER(CountryLanguage.Language) = LOWER(?)';
							if ($stmt = mysqli_prepare($conn, $sql)){	
								mysqli_stmt_bind_param($stmt, "ss", $countryThatUse,$langua) or die("bind param");
								mysqli_stmt_execute($stmt) or die("execute");
								$result = mysqli_stmt_get_result($stmt);
							}	
							$languageId = mysqli_fetch_assoc($result);
							echo "<table style='width:50%' align ='center' cellpadding = '25'>";
							echo "<tr>";
								echo "<caption>" . "Update record from the CountryLanguage table..." . "</caption>" ."<br>";
							echo "</tr>";
							echo "</table>";
							
							echo "<table style='width:50%' align ='center' cellpadding = '6'>";
								echo "<form action='success.php' method='post'>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> CountryCode </td>";
								echo "</tr>";
								
								echo "<td><input type='text' id='txtbox' name='countCode' value='" . $languageId["CountryCode"] . "' readonly/></td>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> Language </td>";
								echo "</tr>";
								
								echo "<td><input type='text' id='txtbox' name='langUsed' value='" . $languageId["Language"] . "' readonly/></td>";
								
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> IsOfficial </td>";
								echo "</tr>";
								
								echo "<td><input type='radio' name='choose' value='T'/>T</td>";
								
								echo "<tr>";
									echo "<td><input type='radio' name='choose' value='F' checked='checked'/>F</td>";
								echo "</tr>";
								
								echo "<tr>";
								echo "<td style = 'font-weight: bold; font-size:100%'> Percentage </td>";
								echo "</tr>";
								
								echo "<td><input type='text' style = 'background-color: white;' id='txtbox' name='langPer' value='" . $languageId["Percentage"] . "'/></td>";
								
								echo "<td><input type='hidden' name='tableName' value='thisIsLanguage'/></td>";
								echo "<tr>";	
									echo "<td><input class='button' name ='save' type='submit' value='Save'/></td>";
								echo "</tr>";
								
								echo "</form>";
							echo "</table>";		
						}
					}
					mysqli_close($conn);
			?>
		</body>
</html>