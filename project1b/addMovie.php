<html>
<head>
  <title> Add actor/director </title>
  <style type = "text/css">
  .requirement{color:red; font-size:x-small}
  .error{color:red; font-size:x-large; font-weight:bold}
  </style> 
</head>

<?php
     $rerror = 0; #error record if any required space is blank 
     if($_SERVER["REQUEST_METHOD"] == "POST"){
		 if (!empty($_POST["title"])){
			 $title = $_POST["title"];
			 $terror = "";		
		 }
		 else{
			 $terror = "Every movie should have a title";
			 $rerror = 1;
	     }
		 if (!empty($_POST["company"])){
			 $company = $_POST["company"];
		 }
		 else{
			 $company = "NULL";
		 }
		 if (!empty($_POST["year"])){
			 $year = $_POST["year"];
		 }
		 else{
			 $year = "NULL";
		 }
		 if (!empty($_POST["rating"])){
			 $rating = $_POST["rating"];
		 }
		 else{
			 $rating = "NULL";
		 }
		 if (!empty($_POST["genre"])){
			 $genre = $_POST["genre"];
			 $gerror = "";
		 }
		 else{
			 $gerror = "Every movie should have a genre";
			 $rerror = 1;
		 }
	 }	 
?>


<body>
<form method = "POST" action = "">
      <h2>Please add your movie here! </h2>
	  <span class = "requirement">required information*</br></br></span>
      Title</br>
	  <input type = "text" name = "title">
	  <span class = "requirement">*<?php print "$terror"; ?></span>
	  </br></br>
	  Company</br>
	  <input type = "text" name = "company">
	  </br></br>
      Year</br> 	  
	  <input type = "text" name ="year">
	  </br></br>
	  MPAA Rating</br>
	  <select name = "rating">
	  <option> </option>
	  <option> G </option>
	  <option> NC-17 </option>
	  <option> PG </option>
	  <option> PG-13 </option>
	  <option> R </option>
	  <option> surrendere </option>
	  </select>
	  </br></br>
	  Genre</br>
	  <select name = "genre">
	  <option> Action </option>
	  <option> Adult </option>
	  <option> Adventure </option>
	  <option> Animation </option>
	  <option> Comedy </option>
	  <option> Crime </option>
	  <option> Documentary </option>
	  <option> Drama </option>
	  <option> Family </option>
	  <option> Fantasy </option>
	  <option> Horror </option>
	  <option> Musical </option>
	  <option> Mystery </option>
	  <option> Romance </option>
	  <option> Sci-Fi </option>
	  <option> Short </option>
	  <option> Thriller </option>
	  <option> War </option>
	  <option> Western </option>
	  </select>
	  <span class = "requirement">*<?php print "$gerror"; ?></span>
	  </br></br>
	  <input type="submit" name="submit" value="Add!">
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
		 $query = "select id from MaxMovieID;";
		 $rs = mysql_query($query, $db_connection);
		 $row = mysql_fetch_row($rs);
		 $id = $row[0] + 1;
         
		 $query = "insert into Movie values($id, '$title', $year, '$rating', '$company')";
		 mysql_query($query, $db_connection);
		 $error = mysql_error();
		 if ($error != '')
		 {
			 print '<p class = "error">Adding person error: '.$error.'</p>';
			 exit(1);
		 }
		 
		 $query = "insert into MovieGenre values($id, '$genre')";
		 mysql_query($query, $db_connection);
		 $error = mysql_error();
		 if ($error != '')
		 {
			 print '<p class = "error">Adding person error: '.$error.'</p>';
			 exit(1);
		 }
		 
		 print 'Successfully Add</br>';
		 $query = "UPDATE MaxMovieID Set id= $id;";
		 $rs = mysql_query($query, $db_connection);
		 
		 /* the code are used to do test*/
		 $query = "select * from Movie where id = $id";
		 $rs = mysql_query($query, $db_connection);
		 while ($row = mysql_fetch_row($rs)){
               for ($i = 0; $i < 5; $i++){
                 print "$row[$i] ";
                }
               print "</br>";				
         }
		 
		 mysql_query($query,$db_connection);
         mysql_close($db_connection);  		 
	 }
?>
</body>
</html>