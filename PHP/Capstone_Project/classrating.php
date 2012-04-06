<?php
	$link = mysql_connect('127.0.0.1:3306', 'root', '');
	$db_selected = mysql_select_db("capstone");
	if (!$db_selected) {
    die ('Could not connect: ' . mysql_error());
	}
	
	$query = "SELECT * FROM ratings WHERE RatingID=1";
	$check = mysql_query($query, $link);
	$result = mysql_query($query);
	
	$q1 = $_POST['q1'];
	$q2 = $_POST['q2'];
	$q3 = $_POST['q3'];
	$q4 = $_POST['q4'];
	$q5 = $_POST['q5'];
	$q6 = $_POST['q6'];
	$q7 = $_POST['q7'];
	$q8 = $_POST['q8'];
	$q9 = $_POST['q9'];
	$q10 = $_POST['q10'];
	$comments = $_POST['comments'];
	
	$rating = ($q1+$q2+$q3+$q4+$q5+$q6+$q7+$q8+$q9+$q10) / 10;

	if(mysql_num_rows($check) < 1){
		mysql_query("INSERT INTO ratings (ClassRating, ClassComments)
				VALUES ('$rating', '$comments')");
		echo "<center><font face=\"tahoma\">Thank you for your submission!</font></center>";
	} else {
		mysql_query("UPDATE ratings SET ClassRating='$rating', ClassComments='$comments' 
					WHERE RatingID=1");
		echo "<center><font face=\"tahoma\">Thank you for your submission!</font></center>";
	}
	
	$redirect = 'student.php';
	echo "<center><font face=\"tahoma\">Click <a href=\"$redirect\">here</a> if your browser does not automatically redirect you</font></center>";
?>

<SCRIPT LANGUAGE="JavaScript">
redirTime = "3550";
redirURL = "<?php echo $redirect ?>";
function redirTimer() { 
self.setTimeout("self.location.href = redirURL;",redirTime);}
</script>
<BODY onLoad="redirTimer()">