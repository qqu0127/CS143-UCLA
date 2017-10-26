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
	<br>Movie<br>
	<select class="form-control" name = "mid">
		<?php
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("CS143", $db_connection);
			$query = "select id, title, year from Movie order by title;";
			$res = mysql_query($query, $db_connection);
			while($row = mysql_fetch_assoc($res)){
				echo '<option value=' . $row['id'] .'>'.$row['title'].'('.$row['year'].')</option>';
			}
		?>
	</select>
	<span class = "requirement">*</span><br>



	<br>Actor<br>
	<select class="form-control" name = "aid">
		<?php
			$query = "select id, first, last, dob from Actor order by first;";
			$res = mysql_query($query, $db_connection);
			while($row = mysql_fetch_assoc($res)){
				echo '<option value=' . $row['id'] .'>'.$row['first'] . ' ' . $row['last'].' ('.$row['dob'].')</option>';
			}
		?>
	</select>
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
		$query = "insert into MovieActor
					values($mid, $aid, '$role')";
		$res = mysql_query($query, $ddb_connectionb);
		mysql_close($db);
		print 'Success!<br>';
	}
?>

</html>