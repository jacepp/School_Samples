<?php
	$link = mysql_connect('127.0.0.1:3306', 'root', '');
	$db_selected = mysql_select_db("capstone");
	if (!$db_selected) {
		die ('Could not connect: ' . mysql_error());
	}
	
	$Time = strtotime( $_POST['duedate'] );
	$Date = date( 'y-m-d', $Time );
	
	$target_path = "assignments/";
	
	$target_path = $target_path . basename( $_FILES['assignment']['name']); 
	
	$Udate = gmDate("Y-m-d\TH:i:s\Z");
	$Name = $_POST['name'];
	$Path = $target_path;
	$Ddate = $Date;
	$Cname = $_POST['cname'];

	if(move_uploaded_file($_FILES['assignment']['tmp_name'], $target_path)) {
		echo "<center><font face=\"tahoma\">The file ".  basename( $_FILES['assignment']['name'])." has been uploaded</font></center>";
		mysql_query("INSERT INTO assignments (UploadDate, AssignName, URL, DueDate)
				VALUES ('$Udate', '$Name', '$Path', '$Ddate')");
	}
	
	$id = mysql_insert_id();
	
	$q1 = "SELECT AssignID FROM assignments WHERE AssignID='$id'";
	$result1 = mysql_query($q1);
	$r1 = mysql_fetch_row($result1);
	$assignID = $r1[0];
	
	$q2 = "SELECT ClassID FROM classes WHERE CourseName='$Cname'";
	$result2 = mysql_query($q2) or die(mysql_error());
	$r2 = mysql_fetch_array($result2);
	$classID = $r2[0];
	
	mysql_query("INSERT INTO classass (AssignID, ClassID)
				 VALUES ($assignID, $classID)");
	
	$redirect = 'teacher.php';
	echo "<center><font face=\"tahoma\">Click <a href=\"$redirect\">here</a> if your browser does not automatically redirect you</font></center>";
?>

<SCRIPT LANGUAGE="JavaScript">
redirTime = "3550";
redirURL = "<?php echo $redirect ?>";
function redirTimer() { 
self.setTimeout("self.location.href = redirURL;",redirTime);}
</script>
<BODY onLoad="redirTimer()">