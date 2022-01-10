<?php 

session_start();



include_once('includes/db_connection.php'); 
$conn = connect_db();
function insert_query($sql)
{$conn = connect_db();
	if (mysqli_query($conn, $sql)) {
  // echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}

?>