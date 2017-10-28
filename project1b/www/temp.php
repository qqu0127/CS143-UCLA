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

<form method = "GET" action = "">
	<input type = "text" name = "searchMovie">
	<input type = "submit" name = "submitMovie" value = "add">
	<?php
		$movie = $_GET["searchMovie"];
		if($movie != ""){
			$db_connection = mysql_connect("localhost", "cs143", "");
			
			mysql_select_db("CS143", $db_connection);
			$query = "select title, year from Movie where title like \"%$movie%\";";
			$res = mysql_query($query, $db_connection);
			
			echo "<br>";
			echo $movie;
			echo "<br>";
			while($row = mysql_fetch_assoc($res)){
				echo $row['title'];
				echo "<br>";
			}

		}

	?>
	
</form>
</body>
</html>