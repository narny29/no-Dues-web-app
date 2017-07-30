<?php
	session_start();
	if(isset($_POST['pass'])){
		$stud = $_POST['pass'];
		$conn = new mysqli('127.0.0.1','accounts','ZadBZ7','accounts');
		$res = $conn->query("SELECT * FROM heads WHERE Username = '".$_SESSION['user']."'");
		$user = $res->fetch_assoc();
		$c = count($stud);
		for($i=0;$i<$c;$i++){
			$conn->query("UPDATE students SET `".$user['Designation']."`='Cleared' WHERE FullName='".$stud[$i]."'");
			echo $stud[$i];
		}
	}
	header('Location: checkdues.php');
?>