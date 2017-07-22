<?php

/*
    Evaluacion Programming php
    Presented by: Paola Sanabria
    To: Catalyst IT
    Date: 22/07/17

    File: insert.php
    Description: Processes the action of the uploading form
                1. Saving the file by default in a temporary folder  
                2. Testing if file is .csv
                3. Redirecting the file to a known TempStorage folder
                4. Validating data in file
                5. Creating database table users
                6. Populating users table
*/

require_once ('connection.php');//----------------creating database connection
include_once 'user_upload.php';

function insertData(){

 
    Global $dbConnection, $directory, $fileName;

    $counter=0;
    $data=array();

    $openFile=fopen($directory, "r"); //--------------------open and read file

    //-----------------checking for fields in the open file - returns an array
    while(($datos=fgetcsv($openFile,1000)) != FALSE){
        $counter++;
        if($counter>1){
            //---------------------------------------adding to data sql syntax
            $data[]='("'.$datos[0].'","'.$datos[1].'","'.$datos[2].'")';
        }
    }

    print_r("<pre>");
    print_r($data);
    print_r("</pre>");
    //----------------------------------------------------SQL query insert data
    $sqlquery="insert into users (Name, Surname, Email)
                    values ". implode(",", $data);

    $dbConnection->exec($sqlquery); //--------------executing query in database

    fclose($openFile);    //----------------------------------closing .csv file
    $remove = unlink('TempStorage/'.$fileName);//----------remove uploaded file 
    $dbConnection = NULL; //-----------------------------------------closing db

}


    
