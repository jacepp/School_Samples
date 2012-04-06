<?php
if(isset($_POST['submit'])){

	$link = mysql_connect('127.0.0.1:3306', 'root', '');
	$db_selected = mysql_select_db("capstone");
	if (!$db_selected) {
    die ('Could not connect: ' . mysql_error());
	}
	
	$check2 = "SELECT UserID FROM profile WHERE UserID=0";
	$target_path = "resumes/";

	$target_path = $target_path . basename( $_FILES['resume']['name']); 

	if(move_uploaded_file($_FILES['resume']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['resume']['name'])." has been uploaded";
	}
	
	$Fname = $_POST['fname'];
	$Lname = $_POST['lname'];
	$Cos = $_POST['cos'];
	$Skills = $_POST['skills'];
	$Resume = $target_path;

	$check = mysql_query($check2, $link) or die("Couldn't execute referral check query.<br>".mysql_error());
	
	if(mysql_num_rows($check) < 1){
		echo "<center><font face=\"tahoma\">Profile has been added to the database!</font></center>";
		mysql_query("INSERT INTO profile (Fname, Lname, Course, Skills, ResumeURL)
		VALUES ('$Fname', '$Lname', '$Cos', '$Skills', '$Resume')");
	} else { 
		mysql_query("UPDATE profile SET Fname='$Fname', Lname='$Lname', Course='$Cos', Skills='$Skills', ResumeURL='$Resume' WHERE UserID=0");
		echo "<center><font face=\"tahoma\">Profile information has been updated!</font></center>"; }
	
}

$redirect = 'student.php';
echo "<center><font face=\"tahoma\">Click <a href=\"$redirect\">here</a> if your browser does not automatically redirect you</font></center>";
?>

<SCRIPT LANGUAGE="JavaScript">
redirTime = "1550";
redirURL = "<?php echo $redirect ?>";
function redirTimer() { 
self.setTimeout("self.location.href = redirURL;",redirTime);}
</script>
<BODY onLoad="redirTimer()">