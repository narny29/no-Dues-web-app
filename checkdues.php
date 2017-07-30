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
input.input{
	font-size:17px;
	padding:10px;
	width:100%;
	border-radius:5px;
	border:1px solid #d8d8d8;
}
input.submit{
	font-size:17px;
	width:100px;
	border:none;
	color:white;
	padding:8px;
	border-radius:3px;
	background:#28282c;
}
</style>
<link rel="stylesheet" type="text/css" href="themes.css">
</head>
<body>
<?php
	session_start();
	if(isset($_SESSION['user'])){
		if(strcmp($_SESSION['type'],"authority")==0){
			$conn = new mysqli('127.0.0.1','accounts','ZadBZ7','accounts');
			
			echo '<div class="options"><a href="logout.php" class="null">Log out</a></div>';
			echo '<div class="main"><h2>Welcome '.$a['Name'].'</h2><br>';
			
			$results = $conn->query("SELECT * FROM students");
			$res = $conn->query("SELECT * FROM heads WHERE Username = '".$_SESSION['user']."'");
			$user = $res->fetch_assoc();
			echo "<h4>".$user['Designation']."</h4>";
			
			echo "<hr><div style='text-align:left;'>";
			echo '<form action="clear.php" method="POST">';
			echo '<table><tr><th>Select</th><th>Name</th><th>Roll Number</th></tr>'; 
			$i = 0;
			while($student = $results->fetch_assoc()){
				if($student[$user['Designation']]=='Not Cleared'){
					if($user['Designation']=='AstRegistrar'){
						if(1){
							if($student['Hostel']==$user['choice']){
								echo '<tr><td>';
								echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
								echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
								echo '</tr>';$i++;
							}
						}
					}else if($user['Designation']=='warden'){
						if($student['Hostel']==$user['choice']){
							if( $student['caretaker']=='Cleared'){
								echo '<tr><td>';
								echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
								echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
								echo '</tr>';$i++;
							}
						}
					}else if($user['Designation']=='ccincharge'){
						if( $student['onlinecc']=='Cleared'){
							echo '<tr><td>';
							echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
							echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
							echo '</tr>';$i++;
						}
					}else if($user['Designation']=='librarian'){
						if( $student['ThesisSubmit']=='Cleared'){
							echo '<tr><td>';
							echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
							echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
							echo '</tr>';$i++;
						}
					}else if($user['Designation']=='HOD'){
						if( $student['AstRegistrar']=='Cleared' && $student['librarian']=='Cleared' && $student['ccincharge']=='Cleared' && $student['DeptLib']=='Cleared' && $student['DeptOffice']=='Cleared' && $student['Workshop']=='Cleared' && $student['Benny George K']=='Cleared' && $student['Purandar Bhaduri']=='Cleared' && $student['Ashish Anand']=='Cleared' && $student['Amit Awekar']=='Cleared' && $student['Santosh Biswas']=='Cleared'){
							echo '<tr><td>';
							echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
							echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
							echo '</tr>';$i++;
						}
					}else if($user['Designation']=='Accounts'){
						if($student['HOD']=='Cleared'){
							echo '<tr><td>';
							echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
							echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
							echo '</tr>';$i++;
						}
					}else if($user['Designation']=='DeptLib' || $user['Designation']=='DeptOffice' || $user['Designation']=='HOD' || $user['Designation']=='ThesisSubmit' || $user['Designation']=='Ashish Anand' || $user['Designation']=='Amit Awekar' || $user['Designation']=='Santosh Biswas' || $user['Designation']=='Purandar Bhaduri' || $user['Designation']=='Benny George K'){
						if($user['choice']==$student['Department']){
							echo '<tr><td>';
							echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
							echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
							echo '</tr>';$i++;
						}
					}else if($user['Designation']=='caretaker'){
						if($student['Hostel']==$user['choice']){
							echo '<tr><td>';
							echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
							echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
							echo '</tr>';$i++;
						}
					}else{
						echo '<tr><td>';
						echo '<input type="checkbox" name="pass[]" value="'.$student['FullName'].'"></input></td>';
						echo '<td>'.$student['FullName'].'</td><td>'.$student['RollNo'].'</td>';
						echo '</tr>';$i++;
					}
				}
			}
			echo '</table>';
			if($i>0){
				echo '<input class="submit" style="padding:5px;font-size:14px;background:#44454c;" type="submit">';
			}else{
				echo "<h4>No Dues to be updated<h4>";
			}
			echo '</input></form>';
			echo "</div>";
			echo '</div>';
		}else{
			echo 'Unknown User or Password <a href="index.php">Go to login page</a>';	
		}
	}else{
		header('Location: login/');
	}
?>
</body>
</html>