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
<h2>Please type in the Director-Movie relation! </h2>
	

<form method = "GET" action = ""><br>
	<span class = "reminder">Don't know the exact name of the movie or director? </span>
	<br>
	<span class = "reminder">No worry, just type in what you know, and select in the box below!</span>
	<br>
	<br>Search Movie:<br>
	<input type = "text" name = "searchMovie"><br>
	<br>Search Actor:<br>
	<input type = "text" name = "searchDirector">
	<input type = "submit" name = "submitMovie" value = "show results">
	<?php
		$movie = $_GET["searchMovie"];
		$director = $_GET["searchDirector"];
		if($movie != "" && $director != ""){
			$db_connection = mysql_connect("localhost", "cs143", "");
			
			mysql_select_db("CS143", $db_connection);
			$queryMovie = "select id, title, year from Movie where title like \"%$movie%\" order by title;";
			$queryDirector = "select id, first, last, dob from Director where first like \"$director%\" or last like \"$director%\" order by first;";
			$resMovie = mysql_query($queryMovie, $db_connection);
			$resDirector = mysql_query($queryDirector, $db_connection);
		}
	?>
</form>

<form method = "POST" action = "">
	<span class = "requirement"> required information*</span><br>
	<br>Movie<br>
	<select class="form-control" name = "mid">
		<?php
			while($row = mysql_fetch_assoc($resMovie))
				echo '<option value=' . $row['id'] .'>'.$row['title'].'('.$row['year'].')</option>';
			mysql_free_result($resMovie);
		?>
	</select>
	<span class = "requirement">*</span><br>

	<br>Director<br>
	<select class="form-control" name = "did">
		<?php
			while($row = mysql_fetch_assoc($resDirector))
				echo '<option value=' . $row['id'] .'>'.$row['first'].' ' . $row['last'] . ' ('.$row['dob'].')</option>';
			mysql_free_result($resDirector);
		?>
	</select>
	<span class = "requirement">*</span><br>
	<br><br>
	<input type = "submit" name = "submit" value = "Add!">
</body>
</form>

<?php
	#required fields:
	# mid, 
	# did
	$error = 0;
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($_POST["mid"]))
			$mid = $_POST["mid"];
		else{
			$error = 1;
			print 'Please specify the Movie id<br>';
			exit(1);
		}
		if(!empty($_POST["did"]))
			$did = $_POST["did"];
		else{
			$error = 1;
			print 'Please specify the Director id<br>';
			exit(1);
		}
	}

	if($error == 0 && $_SERVER["REQUEST_METHOD"] == "POST"){
		$query = "insert into MovieDirector
					values($mid, $did)";
		$res = mysql_query($query, $db_connection);
		mysql_close($db_connection);
		print 'Success!<br>';
	}
?>

</html>