<html>
<head>
<title>Show Movie Information</title>
<style>
h2 { text-align:center;}
.requirement{color:red; font-size:x-small}
</style>
</head>

<body>

<br><p><h2>Actor Information Page</h2></p><br>
<form method = "POST" action = "./search.php">
<input type = "text" name = "search" size = 150px>
<span class = "requirement"><?php print "$serror"; ?></span>
</br></br>
<input type = "submit" name = "submit" value = "Search!">
</form>

<?php
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
		
		$aid = $_GET["aid"];
		if (empty($aid)){
			print 'Aid can not be null.';
			exit(1);
		}
		
        $query = 'select concat_ws(" ", first, last) as name, sex, dob, dod from Actor where id = '.$aid.';';#这里直接用""会错，可能是因为句子中有""，匹配有问题
		if ($error != ''){
		    print '<p class = "error">Searching actor failed: '. error.'</p>';
		    exit(1);
	    }
		
		$rs = mysql_query($query, $db_connection);
        print '<h4>Actor Information: </h4>';
		print '<table border = "1"><tr>';
		print '<td>name</td>';
		print '<td>gender</td>';
		print '<td>date of birth</td>';
		print '<td>date of death</td>';
	    print '</tr>';
		while($row =  mysql_fetch_assoc($rs))
		{
		    print '<tr>';
			print '<td>'.$row['name'].'</td>'; 
			print '<td>'.$row['sex'].'</td>';
			print '<td>'.$row['dob'].'</td>';
			if (!empty($row['dod'])){
				print '<td>'.$row['dod'].'</td>';
			}
			else{
				print '<td>Still alive</td>';
			}
			print '</tr>';
		}
		print '</table>';
		
		$query = 'select M.id, M.title, M.year, M.rating, M.company, MA.role from Movie as M, (select * from MovieActor where aid = '.$aid.') as MA where M.id = MA.mid;';
		$error = mysql_error();
	    if ($error != ''){
		    print '<p class = "error">Searching movie failed: '. error.'</p>';
		    exit(1);
	    }
		
		$rs = mysql_query($query, $db_connection);
        print '<h4>Related movies: </h4>';
		print '<table border = "1"><tr>';
		print '<td>title</td>';
		print '<td>year</td>';
		print '<td>MPAA rating</td>';
		print '<td>company</td>';
		print '<td>role</td>';
	    print '</tr>';
		while($row =  mysql_fetch_assoc($rs))
		{
		    print '<tr>';
			print '<td><a href = "./showMovieInfo.php?mid='.$row['id'].'">'.$row['title'].'</a></td>';
			print '<td>'.$row['year'].'</td>'; 
			print '<td>'.$row['rating'].'</td>';
			print '<td>'.$row['company'].'</td>';
			print '<td>'.$row['role'].'</td>';
			print '</tr>';
		}
		print '</table>';
		
	  }
?>



</body>
</html>