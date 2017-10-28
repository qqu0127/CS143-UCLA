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
<h2>Please type in the actor-movie relation here! </h2>


<form method = "GET" action = ""><br>
	<span class = "reminder">Don't know the exact name of the movie or actor?</span>
	<br>
	<span class = "reminder">No worry, just type in what you know, and select in the box below!</span>
	<br>
	<br>Search Movie:<br>
	<input type = "text" name = "searchMovie"><br>
	<br>Search Actor:<br>
	<input type = "text" name = "searchActor">
	<input type = "submit" name = "submitMovie" value = "show results">
	<?php
		$movie = $_GET["searchMovie"];
		$actor = $_GET["searchActor"];
		if($movie != ""){
			$db_connection = mysql_connect("localhost", "cs143", "");
			
			mysql_select_db("CS143", $db_connection);
			$queryMovie = "select id, title, year from Movie where title like \"%$movie%\" order by title;";
			$queryActor = "select id, first, last, dob from Actor where first like \"%$actor%\" or last like \"%$actor%\" order by first;";
			$resMovie = mysql_query($queryMovie, $db_connection);
			$resActor = mysql_query($queryActor, $db_connection);
		}
	?>
</form>

<span class = "requirement"> required information*</span><br>
<br>


<form method = "POST" action = "">
	<br>Choose Movie<br>
	<select name = "mid">
		<?php
			while($row = mysql_fetch_row($resMovie))
				echo '<option value="',$row[0],'">',$row[1],' (',$row[2],')</option>';
			mysql_free_result($resMovie);
		?>
	</select>
	<span class = "requirement">*</span><br>

	<br>Choose Actor<br>
	<select name = "aid">
		<?php
			while($row = mysql_fetch_row($resActor))
				echo '<option value="',$row[0],'">',$row[1],' ',$row[2],' (', $row[3], ')</option>';
			mysql_free_result($resActor);
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
	if($rerror == 0 and $_SERVER["REQUEST_METHOD"] == "POST"){
		$query = "insert into MovieActor values($mid, $aid, '$role');";
		$res = mysql_query($query, $db_connection) or exit(mysql_error());
		echo "Success!";
		
	}
	mysql_close($db);

?>

</html>