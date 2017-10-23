<html>
<head>
<title>search movie or person here</title>
<style>
h2 { text-align:center;}
.requirement{color:red; font-size:x-small}
</style>
</head>

<body>

<?php
     $rerror = 0;
     if ($_SERVER["REQUEST_METHOD"] == "POST")
	 {
		 if (!empty($_POST["search"])){
			 $search = $_POST["search"];
			 $serror = "";		
		 }
		 else{
			 $serror = "Please enter the search condition";
			 $rerror = 1;
	     }
	 }
?>

<p><h2>You can search information for Movie, Actor here!</h2></p>
<form method = "POST" action = "">
<input type = "text" name = "search" size = 150px>
<span class = "requirement"><?php print "$serror"; ?></span>
</br></br>
<input type = "submit" name = "submit" value = "Search!">
</form>
 
<?php
     if($rerror == 0 and $_SERVER["REQUEST_METHOD"] == "POST"){
	    $db_connection = mysql_connect("localhost", "cs143", "");
	    $error = mysql_error();
	    if ($error != ''){
		    print '<p class = "error">Connection failed: '. error.'</p>';
		    exit(1);
	    }
		 
	    mysql_select_db("CS143", $db_connection);
	    $error = mysql_error();
	    if ($error != '')
 	    {
		    print '<p class = "error">Database connection error: '.$error.'</p>';
		    exit(1);
	    }
		print "<h3>Search result </h3>";
		$wordlist = explode(' ', strtolower($search));
		$length = count($wordlist);
		$searchactor = 'select id, concat_ws(" ", first, last) as name, dob, sex from Actor where 1';
		
		/*search for director can be add here;*/
		
		for ($i = 0; $i < $length; $i++)
		{
			$searchactor .= ' and ( lower(Actor.first) like "%' . $wordlist[$i] . '%" or lower(Actor.last) like "%' .$wordlist[$i]. '%" )';
		}
		$searchactor .=';';
		$rs = mysql_query($searchactor, $db_connection);
		$error = mysql_error();		
		if ($error != '')
		{
			 print '<p class = "error">Searching actor error: '.$error.'</p>';
			 exit(1);
		}
		
        print "<h4>Actor: </h4>";	
		print '<table border = "1"><tr>';
		print '<td>name</td>';
		print '<td>gender</td>';
		print '<td>date of birth</td>';
	    print '</tr>';
		while($row =  mysql_fetch_assoc($rs))
		{
		    print '<tr>';
			print '<td><a href = "./showActorInfo.php?aid='.$row['id'].'">'.$row['name'].'</a></td>'; 
			print '<td>'.$row['sex'].'</td>';
			print '<td>'.$row['dob'].'</td>';
			print '</tr>';
		}
		print '</table>';
    	mysql_close($db_connection);
		
        
    }
?>

</body>
</html>