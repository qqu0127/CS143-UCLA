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
	<select name = "mid">
		<?php
			$db_connection = mysql_connect("localhost", "cs143", "");
			mysql_select_db("CS143", $db_connection);
			$query = "select id, title, year from Movie order by title;";
			$res = mysql_query($query, $db_connection);
			while($row = mysql_fetch_row($res))
				echo '<option value="',$row[0],'">',$row[1],' (',$row[2],')</option>';
			mysql_free_result($res);
		?>
	</select>
	<span class = "requirement">*</span><br>



	<br>Actor<br>
	<select name = "aid">
		<?php
			$query = "select id, first, last, dob from Actor order by first;";
			$res = mysql_query($query, $db_connection);
			while($row = mysql_fetch_row($res))
				echo '<option value="',$row[0],'">',$row[1],' ',$row[2],' (', $row[3], ')</option>';
			mysql_free_result($res);
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
	$mid = $_POST["mid"];
	$aid = $_POST["aid"];
	$role = $_POST["role"];

	if($mid != "" && $aid != ""){
		$query = "insert into MovieActor values($mid, $aid, '$role');";
		$res = mysql_query($query, $db_connection) or exit(mysql_error());
		echo "Success!";
	}
	else{
		echo "Error";
	}
	mysql_close($db);

?>

</html>