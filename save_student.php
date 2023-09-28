<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$name = $_POST['name'];
		$prelim = $_POST['prelim'];
		$midterm = $_POST['midterm'];
		$endterm = $_POST['endterm'];
		
		mysqli_query($conn, "INSERT INTO `student` VALUES('', '$name', '$prelim', '$midterm', '$endterm')") or die(mysqli_error());
		header("location: index.php");
	}
?>
