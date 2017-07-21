<?php
	include_once 'connection.php';
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

		    <form class="form" id="form1" action="insert.php" method="post" enctype="multipart/form-data"> 
		      <p><input type="file" name="csv" id="csv"></p>
			   <button type="submit" class="btnSubmit" value="Submit">Upload .csv file</button>
	        </form>

	        <p class="txtcenter">This sytem uploads only .csv files</p>
			<p class="txtcenter copy">Source <a href="https://github.com/Paolapps/uploadCsv">@github.com/Paolapps</a>
		  <br />Contact <a href="mailto:girapp@outlook.com">Paolapps</a></p>
	 	</div>
		    
	<script src="js/scripts.js"></script>
	</body>
</html>