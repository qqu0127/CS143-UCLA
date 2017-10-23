<html>
<head>
  <title> Add actor/director </title>
  <style type = "text/css">
  .requirement{color:red; font-size:small}
  .reminder{font-size:small}
  .error{color:red; font-size:x-large; font-weight:bold}
  </style> 
</head>

<?php
     $rerror = 0; #error record if any required space is blank 
     if($_SERVER["REQUEST_METHOD"] == "POST"){
		 if (!empty($_POST["profession"])){
			 $profession = $_POST["profession"];
			 $perror = "";		
		 }
		 else{
			 $perror = "Choose a profession please";
			 $rerror = 1;
	     }
		 if (!empty($_POST["firstname"])){
			 $firstname = $_POST["firstname"];
			 $fnerror = "";
		 }
		 else{
			 $fnerror = "First name should not be blank";
			 $rerror = 1;
		 }
		 if (!empty($_POST["lastname"])){
			 $lastname = $_POST["lastname"];
			 $lnerror = "";		 
		 }
		 else{
			 $lnerror = "Last name should not be blank";
			 $rerror = 1;
		 }
		 if (!empty($_POST["gender"])){
			 $gender = $_POST["gender"];
			 $gerror = "";
		 }
		 else{
			 $gerror = "Select a gender please";
			 $rerror = 1;
		 }
		 if (!empty($_POST["dob"])){
			 $dob = $_POST["dob"];
			 $berror = "";
		 }
		 else{
			 $berror = "Date of birth should not be blank";
			 $rerror = 1;
		 }
		 if (!empty($_POST["dod"])){
		     $dod = $_POST["dod"];
		 }
		 else{
			 $dod = "NULL";
		 }
	 }	 
?>


<body>
<form method = "POST" action = "">
      <h2>Please add your actor/director here! </h2>
	  <span class = "requirement">required information*</span><br>
      <br>Profession<br>
	  <select name = "profession">
	  <option> Actor </option>
	  <option> Director </option>
	  </select>
	  <span class = "requirement">*<?php print "$perror"; ?></span>
	  </br></br>
	  First Name</br>
	  <input type = "text" name = "firstname">
	  <span class = "requirement">*<?php print "$fnerror"; ?></span>
	  </br></br>
      Last Name</br> 	  
	  <input type = "text" name ="lastname">
	  <span class = "requirement">*<?php print "$lnerror"; ?></span>
	  </br></br>
	  Gender</br>
	  <select name = "gender">
	  <option> Male </option>
	  <option> Female </option>
	  </select>
	  <span class = "requirement">*<?php print "$gerror";?></span>
	  </br></br>
	  Date of Birth</br>
	  <input type = "date" name = "dob" maxlength = "8">
	  <span class = "requirement">*<?php print "$berror";?></span>
	  </br>
	  <span class = "reminder">according to your browser, choose the date or enter like 19940608</span>
	  </br></br>
	  Date of Death</br>
	  <input type = "text" name = "dod" maxlength = "8">
	  </br>
	  <span class = "reminder">please leave here blank if this person is still alive</span>
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
		 $query = "select id from MaxPersonID;";
		 $rs = mysql_query($query, $db_connection);
		 $row = mysql_fetch_row($rs);
		 $id = $row[0] + 1;

		 $query = "insert into $profession values($id, '$lastname', '$firstname', '$gender', $dob, $dod)";
		 mysql_query($query, $db_connection);
		 $error = mysql_error();
		 if ($error != '')
		 {
			 print '<p class = "error">Adding person error: '.$error.'</p>';
			 exit(1);
		 }
		 
		 print 'Success!</br>';
		 $query = "UPDATE MaxPersonID Set id= $id;";
		 $rs = mysql_query($query, $db_connection);
		 
		 /* the code are used to do test
		 $query = "select * from $profession where id = $id";
		 $rs = mysql_query($query, $db_connection);
		 while ($row = mysql_fetch_row($rs)){
               for ($i = 0; $i < 6; $i++){
                 print "$row[$i] ";
                }
               print "</br>";				
         }*/
		 
		 mysql_query($query,$db_connection);
         mysql_close($db_connection);  		 
	 }
?>
</body>
</html>