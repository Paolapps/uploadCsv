<?php

require_once ('connection.php');

$route="TempStorage/";

foreach ($_FILES as $key) {
    $fileName= $key['name'];
    $route_tmp = $key["tmp_name"];
    //print_r($fileName);
    print_r($route_tmp);

    $directory = $route.$fileName;
    $explo=explode(".", $fileName);

    if($explo[1] <> "csv"){
    	$alert = 1;
    }
    else{
    	if(move_uploaded_file($route_tmp, $directory)){
    		$alert = 2;
        }
    }
}

$x=0;
$data=array();
//opening file
$fichero=fopen($directory, "r");

//checking for CSV fields in the open file - returns an array
while(($datos= fgetcsv($fichero,1000)) != FALSE){

        $x++;
        if($x>1){

            $data[]='("'.$datos[0].'","'.$datos[1].'","'.$datos[2].'")';

        }

    }

    print_r("<pre>");
        print_r($data);
    print_r("</pre>");

    $sqlquery="insert into users (Name, Surname, Email)
                        values ". implode(",", $data);
    //mysqli($sqlquery);
    $dbConnection->exec($sqlquery);
    fclose($fichero);
    
    print_r("<pre>");
        print_r($sqlquery);
    print_r("</pre");

