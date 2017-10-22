<html>
<head><title> CS143 Project 1A </title></head>
<body>
	<h1> Movie Database</h1>
	<p> Type in SQL query in the following box: </p>
	<p> Example: select * from Actor where id < 20; </p>
	<form action="" method="GET">
		<textarea name="query" cols = "60" rows="8"><?php echo $_GET["query"];?></textarea><br/>
		<input type="submit" value="Submit" />
	</form>
	<?php
	if(!isset($_GET["query"]))
		die("Please enter a query.");
	//setup connection using specified user name and password
	$db = mysql_connect("localhost", "cs143", ""); 
	if(!$db)
		die("Unable to connect database " . mysql_error());
	//select database CS143
	$db_CS143 = mysql_select_db("CS143", $db);
	if(!$db_CS143)
		die("Unable to select database CS143 " . mysql_error());
	//GET query
	$query_get = $_GET["query"];
	if(!$query_get)
		die("Unable to get the query " . mysql_error());
	$res = mysql_query($query_get); // get the query result
	if(!$res)
		die("Unable to get the query results " . mysql_error());
	
	/* Parse and display the results */

	echo "<h3>Results from back-end Database CS143: </h3>\n";
	echo "<table border=1 cellspacing=1 cellpadding=2>\n";
	echo "<tr align=center>";
	//display the field names
	for($i = 0; $i < mysql_num_fields($res); $i++){
		$meta = mysql_fetch_field($res, $i);
		echo "<td><b>" . $meta->name . "</b></td>\n";
	}
	//fetch each row of the results table
	while($row = mysql_fetch_row($res)){
		echo "</tr>\n";
		echo "<tr align=center>";
		for($i = 0; $i < mysql_num_fields($res); $i++){
			$ent = $row[$i];
			if(is_null($ent))
				$ent = "n/a";
			echo "<td>" . htmlspecialchars($ent) . "</td>";
		}
	}
	mysql_free_result($res);
	mysql_close($db);
	echo "</table>\n"
	?>
</body>
</html>
