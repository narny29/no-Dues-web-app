<html>
<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}
th{
	background:#383868;
	color:white;
}
tr:nth-child(even){background-color: #f2f2f2}
</style>
<link rel="stylesheet" type="text/css" href="themes.css">
</head>
<body style="margin:0px;padding:0px;">
<?php
	session_start();
	if(isset($_SESSION['user'])){
		if(strcmp($_SESSION['type'],"authority")==0){
			header("Location: checkdues.php");
		}else if(strcmp($_SESSION['type'],"student")==0){
			echo '<div class="options"><a href="logout.php" class="null">Log out</a></div>';
			
			$conn = new mysqli('127.0.0.1','accounts','ZadBZ7','accounts');
			$result = $conn->query("SELECT * FROM `students` WHERE Username='".$_SESSION['user']."'");
			$row = $result->fetch_assoc();
			
			echo '<div class="main"><h2>Welcome '.$row['FullName'].'</h2><br>';
			echo '<div class="rollno">'.$row['RollNo'].'</div><div class="dept">'.$row['Department'].'</div><br><br>';
			echo '<table><tr><th>Designation</th><th>Status</th></tr>';
			echo '<tr><td>Hostel Care Taker</td><td>'.$row['caretaker'].'</td></tr>';
			echo '<tr><td>Warden</td><td>'.$row['warden'].'</td></tr>';
			echo '<tr><td>Assistant Registrar</td><td>'.$row['AstRegistrar'].'</td></tr>';
			echo '<tr><td>Gymkhana</td><td>'.$row['Gymkhana'].'</td></tr>';
			echo '<tr><td>Thesis Submission</td><td>'.$row['ThesisSubmit'].'</td></tr>';
			echo '<tr><td>Library</td><td>'.$row['librarian'].'</td></tr>';
			echo '<tr><td>Online cc dues</td><td>'.$row['onlinecc'].'</td></tr>';
			echo '<tr><td>CC incharge</td><td>'.$row['ccincharge'].'</td></tr>';
			echo '<tr><td>Department Library</td><td>'.$row['DeptLib'].'</td></tr>';
			echo '<tr><td>Department Office</td><td>'.$row['DeptOffice'].'</td></tr>';
			echo '<tr><td>Mechanical Workshop</td><td>'.$row['Workshop'].'</td></tr>';
			echo '<tr><td>Head of Department clearance</td><td>'.$row['HOD'].'</td></tr>';
			echo '<tr><td>Accounts Section Final Clearance</td><td>'.$row['Accounts'].'</td></tr>';
			echo '</table>';
			echo '<br>';
			if($row['caretaker']=='Cleared' && $row['warden']=='Cleared' && $row['AstRegistrar']=='Cleared'&& $row['Gymkhana']=='Cleared'&& $row['ThesisSubmit']=='Cleared'&& $row['librarian']=='Cleared'&& $row['onlinecc']=='Cleared'&& $row['ccincharge']=='Cleared'&& $row['DeptLib']=='Cleared'&& $row['DeptOffice']=='Cleared'&& $row['Workshop']=='Cleared'&& $row['HOD']=='Cleared'&& $row['Accounts']=='Cleared'){
				echo '<input type="submit" value="Print Copy of No dues form"/>';
			}
			echo '<br><br><br><br></div>';
		}
	}else{
		header("Location: login/");
	}
?>
</body>
</html>