<?php
/*
	Evaluacion Programming php
	Presented by: Paola Sanabria
	To: Catalyst IT
	Date: 22/07/17

	File: connection.php
	Description: Makes connection to csv_files MySQL database
*/
Global $dbConnection;
//-----------------------------------------Database Connection Variables
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$db = "csv_files"; 
$dbInfo = "mysql:host=$dbHost; dbname=$db;";

//------------------------------------------------------Global Variables
$dbConnection = NULL;
$result = NULL;
$numRecords = NULL;

//--------------------------------------------Establish MySQL Connection 
try{
		//Create a PDO connection with the configuration data
		$dbConnection = new PDO($dbInfo, $dbUser, $dbPassword);
		$dbConnection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $error){
		//Display error message if there is no connection
		echo "Opps! An error occured: ".$error->getMessage();
}


