<?php

 $servername = "127.0.0.1";
 $username = "banah";
 $password = "ABC123";
 $dbname = "projet";


 $conn = mysqli_connect($servername, $username, $password, $dbname,3308);


 if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
	}
?>
