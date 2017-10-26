<html>
<head>
  <title> Add Comments to Movie </title>
  <style type = "text/css">
  .requirement{color:red; font-size:small}
  .reminder{font-size:small}
  .error{color:red; font-size:x-large; font-weight:bold}
  </style> 
</head>

<body>
<form method = "POST" action = "addComments.php">
	<h2>Please add the comments here! </h2>
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
		<option value=5>100 Girls (2000)</option>
		<option value=6>100 Kilos (2001)</option>
		<option value=8>13th Child (2002)</option>
	</select>
	<span class = "requirement">*</span><br>

	<br>Rating<br>
	<select name = "rating">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
	</select>
	<span class = "requirement">*</span><br>

	<br>Comment<br>
	<input type = "text" name = "comment">
	<br><span class = "reminder"> Not required, but you are welcome to leave any comment!</span><br>
	<br>Your Name<br>
	<input type = "text" name = "userName">
	<br><br>

	<input type = "submit" name = "submit" value = "Add!">
</body>
</form>


<?php
	#required fields:
	# mid, 
	# at least one should be not null: rating, comment
	$error = 0;
	$eMsg = "";
	$comment = "";
	$userName = "N/A";
	$noComment = 0;

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$timeStamp = date('Y-m-d G:i:s');
		
		if(!empty($_POST["mid"]))
			$mid = $_POST["mid"];
		else{
			$error = 1;
			print 'Please specify the Movie id<br>';
			exit(1);
		}
		
		if(!empty($_POST["userName"]))
			$userName = $_POST["userName"];

		if(!empty($_POST["rating"]))
			$rating = $_POST["rating"];
		else{
			$error = 1;
			print 'Please specify the rating<br>';
			exit(1);
		}

		if(!empty($_POST["comment"]))
			$comment = $_POST["comment"];
	}

	if($error == 0 && $_SERVER["REQUEST_METHOD"] == "POST"){
		$db = mysql_connect("localhost", "cs143", ""); 
		if(!$db)
			die("Unable to connect database " . mysql_error());
		//select database CS143
		$db_CS143 = mysql_select_db("CS143", $db);
		if(!$db_CS143)
			die("Unable to select database CS143 " . mysql_error());
		$query = "insert into Review
					values('$userName', '$timeStamp', $mid, $rating, '$comment')";
		$res = mysql_query($query, $db);
		mysql_close($db);
		print 'Success!<br>';
	}
?>

</html>