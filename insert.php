<?php

/*
    Evaluacion Programming php
    Presented by: Paola Sanabria
    To: Catalyst IT
    Date: 22/07/17

    File: insert.php
    Description: Processes the action of the uploading form
                1. Extract data from file csv
                2. Validating data in file
                3. Creating database table users
                4. Populating users table
*/

require_once ('connection.php');//----------------creating database connection
include_once 'user_upload.php';

function insertData(){
    
    header('Content-Type: text/html; charset=utf-8');

    Global $dbConnection, $directory, $fileName, $data;

    $rows=0;
    $data=array();

    $openFile=fopen($directory, "r"); //--------------------open and read file

    //-----------------checking for fields in the open file - returns an array
    while(($fields=fgetcsv($openFile,1000)) != FALSE){
        $rows++;
        if($rows>1){
            //---------------------------------------adding to data sql syntax

           $data[]='("'.trim(ucwords(strtolower($fields[0]))).'","'
                    .trim(ucwords(strtolower($fields[1]))).'","'.trim($fields[2]).'")';

           $name []= $fields[0];
           $surname []= $fields[1];
           $email []= $fields[2];
        }
    }

    
    //------------------------------------------------------name validation  
    //echo ("<pre>");
    //print_r($name); 

    $rexNoCharac = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/";//--no special characters  
    $rexAlphaSpace = "/^[a-zA-Z ]*$/";//----------------only alpha characters
      
    foreach ($name as $n) {
        if($n == NULL){
            throw new RuntimeException('<center>Any field name remains empty, 
                all names are required</center>');
        }
        else if((strlen($n) >= 30 )){
            throw new RuntimeException('<center>Name exceeds maximum length</center>');
            }
        else if (preg_match($rexNoCharac, $n)) {
            throw new RuntimeException('<center>There are no valid names. </br>
                No special characters allowed</center>');
            } 
        else if (!preg_match($rexAlphaSpace, $n)) {
            throw new RuntimeException('<center>Only letters and white spaces 
                allowed in name field</center>');
           }
    }

    //------------------------------------------------------surname validation    
      
    foreach ($surname as $s) {
        if($s == NULL){
            throw new RuntimeException('<center>Any field surname remains empty, 
                all surnames are required</center>');
        }
        else if((strlen($s) >= 30 )){
            throw new RuntimeException('<center>Surname exceeds maximum 
                length</center>');
            } 
        else if (preg_match($rexNoCharac, $s)) {
            throw new RuntimeException('<center>There are no valid surnames. </br>
                No special characters allowed</center>');
            }
    }

     //------------------------------------------------------email validation    
      
    foreach ($email as $e) {
        if($e == NULL){
            throw new RuntimeException('<center>Any field email remains empty, 
                all emails are required</center>');
        }
        else if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('<center>There are no valid emails. </br>
                </center>');
            }
    }

    //----------------------------------------------------SQL query insert data
    $sqlquery="insert into users (Name, Surname, Email)
                    values ". implode(",", $data);

    try{
        $dbConnection->exec($sqlquery); //--------------executing query in database
        throw new RuntimeException('<center>Your file has been uploaded</br>
                </center>');
    }
    catch(PDOExeption $error){
        $sqlError = ($dbConnection->errorInfo());
        if ($sqlError[1] == 1062) //---------------------primary key duplicates
        throw new RuntimeException('<center>There are no valid emails.</br>'
            .$error->getMessage().'</center>');
    }
    
    fclose($openFile);    //----------------------------------closing .csv file
    $remove = unlink('TempStorage/'.$fileName);//----------remove uploaded file 
    $dbConnection = NULL; //-----------------------------------------closing db



}


    
