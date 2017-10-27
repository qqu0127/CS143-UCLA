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
	  Genre
	  <span class = "requirement">*<?php print "$gerror </br>"; ?></span>
	  <input type = "checkbox" name = "genre[]" value =  "Action"> Action 
	  <input type = "checkbox" name = "genre[]" value =  "Adult"> Adult
	  <input type = "checkbox" name = "genre[]" value =  "Adventure"> Adventure 
	  <input type = "checkbox" name = "genre[]" value =  "Animation"> Animation 
      <input type = "checkbox" name = "genre[]" value =  "Comedy"> Comedy 
      <input type = "checkbox" name = "genre[]" value =  "Crime"> Crime 
      <input type = "checkbox" name = "genre[]" value =  "Documentary"> Documentary 
      <input type = "checkbox" name = "genre[]" value =  "Drama"> Drama 
	  <input type = "checkbox" name = "genre[]" value =  "Family"> Family 
	  <input type = "checkbox" name = "genre[]" value =  "Fantasy"> Fantasy 
	  <input type = "checkbox" name = "genre[]" value =  "Horror"> Horror 
	  <input type = "checkbox" name = "genre[]" value =  "Musical"> Musical 
      <input type = "checkbox" name = "genre[]" value =  "Mystery"> Mystery 
      <input type = "checkbox" name = "genre[]" value =  "Romance"> Romance 
      <input type = "checkbox" name = "genre[]" value =  "Sci-Fi"> Sci-Fi 
      <input type = "checkbox" name = "genre[]" value =  "Short"> Short 
	  <input type = "checkbox" name = "genre[]" value =  "Thriller"> Thriller 
      <input type = "checkbox" name = "genre[]" value =  "War"> War 
      <input type = "checkbox" name = "genre[]" value =  "Western"> Western 
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
		 
		 foreach ($genre as $i)
		 {
			 $query = "insert into MovieGenre values($id, '$i')";
		     mysql_query($query, $db_connection);
		     $error = mysql_error();
		     if ($error != '')
		     {
			     print '<p class = "error">Adding person error: '.$error.'</p>';
				 print 'here'.$query.'</br>';
			     exit(1);
				 
				 $query = "delete from Movie where id = $id";
				 mysql_query($query, $db_connection);
		     }
		 }
		 
		 print 'Successfully Add</br>';
		 $query = "UPDATE MaxMovieID Set id= $id;";
		 mysql_query($query, $db_connection);
		 
		 /* this code are just used to do test*/
		 /*
		 $query = "select * from Movie where id = $id";
		 $rs = mysql_query($query, $db_connection);
		 while ($row = mysql_fetch_row($rs)){
               for ($i = 0; $i < 5; $i++){
                 print "$row[$i] ";
                }
               print "</br>";				
         }
		 $query = "select * from MovieGenre where mid = $id";
		 $rs = mysql_query($query, $db_connection);
		 while ($row = mysql_fetch_row($rs)){
               for ($i = 0; $i < 5; $i++){
                 print "$row[$i] ";
                }
               print "</br>";				
         }
		 */
		 
         mysql_close($db_connection);  		 
	 }
?>
</body>
</html>