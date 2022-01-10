<?php
function connect_db(){
$val = 0; 
if($val==0){
$servername = "localhost";
$username = "root";
$password = "";
 $dbname = "project_waleed";}
 if($val==1){
 	$servername = "localhost";
	$username = "jgecynbrge";
	$password = "xqPMz8JgUn";
 	$dbname = "jgecynbrge";
 }

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	// echo "hello";
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
return $conn;
}
$connect = new PDO("mysql:host=localhost;dbname=project_waleed", "root", "");

?>