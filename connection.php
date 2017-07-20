<?php
/*

*/
//Database Connection Variables
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$db = "csv_files"; 
$dbInfo = "mysql:host=$dbHost; dbname=$db;";

//Declare Global Variables
$dbConnection = NULL;
$result = NULL;
$numRecords = NULL;

//Establish MySQL Connection 
try
	{
		//Create a PDO connection with the configuration data
		$dbConnection = new PDO($dbInfo, $dbUser, $dbPassword);
		$dbConnection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $error)
	{
		//Display error message if applicable
		echo "An error occured: ".$error->getMessage();
	}

?>
