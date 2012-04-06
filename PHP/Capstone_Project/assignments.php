<?php
	$link = mysql_connect('127.0.0.1:3306', 'root', '');
    mysql_select_db("capstone");
    
	$classid = $_GET['classID'];
	$query = "SELECT * FROM classass WHERE ClassID='$classid'";
    $result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_array($result)){
		$assignid = $row['AssignID'];
		$query2 = "SELECT * FROM assignments WHERE AssignID='".$assignid."'";
		$result2 = mysql_query($query2) or die(mysql_error());
		
		echo "<dl>";
		while($row2 = mysql_fetch_array($result2)){
			echo "<dt><a href=\"".htmlentities($row2['URL'])."\" target=\"_blank\">".htmlentities($row2['AssignName']." ".$row2['DueDate'])."</a></dt>";
		}
		echo "</dl>";
	}
?>

