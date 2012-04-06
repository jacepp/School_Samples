<?php
$link = mysql_connect('127.0.0.1:3306', 'root', '');
$db_selected = mysql_select_db("capstone");
if (!$db_selected) {
    die ('Could not connect: ' . mysql_error());
}
// needs to be replaced with UseID or some sort of SessionID
$query = "SELECT * FROM profile WHERE UserID=0";
$check = mysql_query($query, $link);
$result = mysql_query($query);

if(mysql_num_rows($check) < 1){
	$Fname = "";
	$Lname = "";
	$Cos = "";
	$Skills = "";
	$Resume = "";
} else {
	while($row = mysql_fetch_array($result)){
		$Fname = htmlentities($row['Fname']);
		$Lname = htmlentities($row['Lname']);
		$Cos = htmlentities($row['Course']);
		$Skills = htmlentities($row['Skills']);
		$Resume = htmlentities($row['ResumeURL']);
		echo "<a href=\"<?php echo $Resume; ?>\" target=\"_blank\">Your Resume</a>";
	}
}
?>

<html>
<head>
</head>
<body>
	<form enctype="multipart/form-data" name="studentprofile" method="post" action="saveprofile.php">
		<table>
			<tr>
				<td>
					<label>First Name</label>
				</td>
				<td>
					<input  type="text" name="fname" id="fname" value="<?php echo $Fname; ?>" size="30">
				</td>
			</tr>
 
			<tr>
				<td>
					<label>Last Name</label>
				</td>
				<td>
					<input  type="text" name="lname" id="lname" value="<?php echo $Lname; ?>" size="30">
				</td>
			</tr>
			<tr>
				<td>
					<label>Course of Study</label>
				</td>
				<td>
					<input  type="text" name="cos" id="cos" value="<?php echo $Cos; ?>" size="30">
				</td>
 
			</tr>
			<tr>
				<td>
					<label>Skills</label>
				</td>
				<td>
					<input  type="text" name="skills" id="skills" value="<?php echo $Skills; ?>" size="30">
				</td>
			</tr>
			<tr>
				<td>
					<label>Upload Resume</label>
				</td>
				<td>
					<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
					<input name="resume" id="resume" type="file" />
				</td>
 
			</tr>
			<tr>
				<td>
					<input type="submit" name="submit" value="Submit"> 
				</td>
			</tr>
		</table>
	</form>
</body>
</html>