<html>
<head>
  <title> Add Comments to Movie </title>
  <style type = "text/css">
  .requirement{color:red; font-size:x-small}
  .reminder{font-size:x-small}
  .error{color:red; font-size:x-large; font-weight:bold}
  </style> 
</head>

<?php
	#required fields:
	# mid, 
	# at least one should be not null: rating, comment
	$error = 0;
	$eMsg = "";
	$noRating = 0;
	$noComment = 0;
	//$timeStamp = date('Y-m-d G:i:s');
	//echo "<h3>" . $timeStamp . "</h3>";
	
	//if($_SERVER["REQUEST_METHOD"] == "POST"){
		$timeStamp = date('Y-m-d G:i:s');
		echo "<h3>" . $timeStamp . "</h3>";
		
		if(!empty($_POST["mid"]))
			$mid = $_POST["mid"];
		else{
			$error = 1;
			$eMsg = "Please specify the Movie id";
		}
		
		if(!empty($_POST["userName"]))
			$userName = $_POST["userName"];
		else
			$userName = "N/A";
		
		if(!empty($_POST["rating"]))
			$rating = $_POST["rating"];
		else{
			$rating = "N/A";
			$noComment = 1;
		}

		if(!empty($_POST["comment"]))
			$comment = $_POST["comment"];
		else{
			$comment = "N/A";
			$noComment = 1;
		}

		if($noComment == 1 && $noRating == 1)
			$error = 2;
	//}

?>
<body>
<form method = "POST" action = "">
	<h2>Please add the comments here! </h2>
	<span class = "requirement"> required information*</span>
	<br>Movie id<br>
	<input type = "text" name = "mid">
	<span class = "requirement">*</span><br>

	<br>Rating<br>
	<input type = "number" name = "rating"><br>
	<br>Comments<br>
	<input type = "text" name = comment"><br>
	<br>Your Name<br>
	<input type = "text" name = "userName"><br>
	<br><br>

	<input type = "submit" name = "submit" value = "Add!">
</body>
</form>

<?php
	if($error == 0 && $_SERVER["REQUEST_METHOD"] == "POST"){
		echo "<h3>" . $userName . $timeStamp . $mid . $rating . $comment ." </h3>";
		$db = mysql_connect("localhost", "cs143", ""); 
		if(!$db)
			die("Unable to connect database " . mysql_error());
		//select database CS143
		$db_CS143 = mysql_select_db("CS143", $db);
		if(!$db_CS143)
			die("Unable to select database CS143 " . mysql_error());
		$query = "insert into Review
					values($userName, $timeStamp, $mid, $rating, $comment)";
		$res = mysql_query($query);
		mysql_close($db);
	}
?>

</html>