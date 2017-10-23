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
<form method = "POST" action = "">
	<h2>Please add the comments here! </h2>
	<span class = "requirement"> required information*</span><br>
	<br>Movie id<br>
	<input type = "text" name = "mid">
	<span class = "requirement">*</span><br>

	<br>Rating<br>
	<input type = "number" name = "rating">
	<span class = "requirement">*</span>
	<br><span class = "reminder"> Any integer from 0 to 100<br></span>

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