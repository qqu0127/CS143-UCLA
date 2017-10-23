<html>
<head>
  <title> Add Actor to Movie </title>
  <style type = "text/css">
  .requirement{color:red; font-size:small}
  .reminder{font-size:small}
  .error{color:red; font-size:x-large; font-weight:bold}
  </style> 
</head>

<body>
<form method = "POST" action = "">
	<h2>Please type in the actor-movie relation here! </h2>
	<span class = "requirement"> required information*</span><br>
	<br>Movie id<br>
	<input type = "number" name = "mid">
	<span class = "requirement">*</span><br>

	<br>Actor id<br>
	<input type = "number" name = "aid">
	<span class = "requirement">*</span><br>
	<br>role<br>
	<input type = "text" name = "role">
	<span class = "requirement">*</span><br>

	<br><br>
	<input type = "submit" name = "submit" value = "Add!">
</body>
</form>


<?php
	#required fields:
	# mid, 
	# aid
	# role
	$error = 0;
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($_POST["mid"]))
			$mid = $_POST["mid"];
		else{
			$error = 1;
			print 'Please specify the Movie id<br>';
			exit(1);
		}
		if(!empty($_POST["aid"]))
			$aid = $_POST["aid"];
		else{
			$error = 1;
			print 'Please specify the actor id<br>';
			exit(1);
		}
		
		if(!empty($_POST["role"]))
			$role = $_POST["role"];
		else{
			$error = 1;
			print 'Please specify the role<br>';
			exit(1);
		}
	}

	if($error == 0 && $_SERVER["REQUEST_METHOD"] == "POST"){
		$db = mysql_connect("localhost", "cs143", ""); 
		if(!$db)
			die("Unable to connect database " . mysql_error());
		//select database CS143
		$db_CS143 = mysql_select_db("CS143", $db);
		if(!$db_CS143)
			die("Unable to select database CS143 " . mysql_error());
		$query = "insert into MovieActor
					values($mid, $aid, '$role')";
		$res = mysql_query($query, $db);
		mysql_close($db);
		print 'Success!<br>';
	}
?>

</html>