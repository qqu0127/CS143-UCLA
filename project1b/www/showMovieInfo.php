<html>
<head>
<title>Show Movie Information</title>
<style>
h1 { text-align:center;}
.requirement{color:red; font-size:small}
</style>
</head>

<body>

<br><p><h1>Movie Information page</h1></p><br>

<?php
	//TODO:
	//86~91 part B, part C

	if($_SERVER["REQUEST_METHOD"] == "GET"){
	    $db_connection = mysql_connect("localhost", "cs143", "");
	    $error = mysql_error();
	    if ($error != ''){
		    print '<p class = "error">Connection failed: '. error.'</p>';
		    exit(1);
	    }
		 
	    mysql_select_db("CS143", $db_connection);
	    $error = mysql_error();
	    if ($error != ''){
		    print '<p class = "error">Database connection error: '.$error.'</p>';
		    exit(1);
	    }
		
		$mid = $_GET["mid"];
		if (empty($mid)){
			print 'Mid can not be null.';
			exit(1);
		}

		//A: movie info
		print '<h2>Movie Infomation: </h2>';
		$query = 'select title, year, rating, company from Movie
			where id =' . $mid .';';

		if ($error != ''){
		    print '<p class = "error">Searching actor failed: '. error.'</p>';
		    exit(1);
	    }
		$res = mysql_query($query, $db_connection);
		$row = mysql_fetch_row($res);
		mysql_free_result($res);
		print "Title: $row[0]<br>";
		print "Year: $row[1]<br>";
		print "MPAA Rating: $row[2]<br>";
		if($row[3] == null)
			print 'Company: N/A<br>';
		else
			print 'Company: ' . $row[3] . '<br>';
		//
		$query = 'select first, last, dob
				from MovieDirector, Director
				where id = did
				and mid =' . $mid
				. ';';
		if ($error != ''){
		    print '<p class = "error">Searching actor failed: '. error.'</p>';
		    exit(1);
	    }
		$res = mysql_query($query, $db_connection);
		$row = mysql_fetch_row($res);
		mysql_free_result($res);

		if($row[0] == "")
			print "Director: <br>";
		else
			print "Director: $row[0] $row[1]($row[2])<br>";

		$query = 'select genre from MovieGenre
			where mid =' . $mid .';';
		if ($error != ''){
		    print '<p class = "error">Searching actor failed: '. error.'</p>';
		    exit(1);
	    }
		$res = mysql_query($query, $db_connection);
		$row = mysql_fetch_row($res);
		print "Genre: $row[0]<br>"; 
		//B: actors in the movie
		print '<h2>Actors in this Movie: </h2>';


		//C: User Reviews:
		print '<h2>User Reviews: </h2>';
		

	}
?>
</body>
</html>
