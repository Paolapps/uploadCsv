<?php

/*  Evaluacion Programming php
    Presented by: Paola Sanabria
    To: Catalyst IT
    Date: 22/07/17

    File: user_upload.php
    Description: Html form for file uploading, redirecting to insert.php 
  				 Processes the action of the uploading form
                1. Saving the file by default in a temporary folder  
                2. Testing if file is .csv
                3. Redirecting the file to a known TempStorage folder
 */

	include_once 'connection.php';
	include_once 'insert.php';
?>
	
<!doctype html>
<html lang="en">
	<head>
	  <meta charset="utf-8">

	  <title>Evaluation Paola</title>
	  <meta name="description" content="Cathalyst Programming Evaluation">
	  <meta name="author" content="Paola Sanabria">

	  <link rel="stylesheet" href="css/styleUpload.css">
	</head>

	<body>
		<div id="form-div">
		  <h1>Programming PHP Evaluation</h1>
			<h2>Paola Sanabria</h2>

		    <form class="form" id="form1" action="" method="post" enctype="multipart/form-data"> 
		      <p><input type="file" name="upfile" id="upfile"></p>
			   <button type="submit" class="btnSubmit" value="Submit">Upload .csv file</button>
	        </form>

	        <?php
	       		
	       		header('Content-Type: text/html; charset=utf-8');

	       		Global $directory;

	       		echo '<p style ="  margin-top: 2em; font-size: 1em; text-align: center; color: #a7eefd;"';

				try {
				   
			// --------------------------------------Check $_FILES['upfile']['error'] value

				    // ---------------------------------Undefined <input type="file"> error
				    if (!isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error'])){
				        throw new RuntimeException('<center>This system uploads only .csv files</center>');
				    }

				    switch ($_FILES['upfile']['error']) {
				        case UPLOAD_ERR_OK:
				            break;
				        case UPLOAD_ERR_NO_FILE:
				            throw new RuntimeException('<center>No file sent</center>');
				        case UPLOAD_ERR_EXTENSION: 
				        default:
				            throw new RuntimeException('<center>Unknown error occurred</center>');
				    }
  			
  			//----------------------------------------------------move file to new directory
				    $folder="TempStorage/";//-------------------------uploadCsv/TempStorage/

				    foreach ($_FILES as $key) {
				        $fileName = $key['name'];
				        $folder_tmp = $key["tmp_name"];
				        
						//-----------------------------------------checking  if file is .cvs
				        $explo=explode(".", $fileName);  
				        $directory = $folder.$fileName;

				        if($explo[1] <> "csv"){
				            throw new RuntimeException('<center>Opps! Invalid file format.</center>');
				        }
				        else{
				            if(move_uploaded_file($folder_tmp, $directory)){
				                insertData();
				            }
				            else
				            	throw new RuntimeException('<center>Failed the uploading</center>');
				        }
				    }

				} catch (RuntimeException $e) {
				    echo $e->getMessage();
				}
				
				echo "</p>";
			?>

			<p class="txtcenter copy">Source <a href="https://github.com/Paolapps/uploadCsv">
				@github.com/Paolapps</a><br />
				Contact <a href="mailto:girapp@outlook.com">Paolapps</a></p>
	 	</div>
		    
	</body>
</html>