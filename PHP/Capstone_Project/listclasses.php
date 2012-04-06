<?php
	$link = mysql_connect('127.0.0.1:3306', 'root', '');
    mysql_select_db("capstone");
    //userID needs to be sessionID
	$query = "SELECT * FROM classusers WHERE UserID=2";
    $result = mysql_query($query) or die(mysql_error());
	
	while($row = mysql_fetch_array($result)){
		$classid = $row['ClassID'];
		$query2 = "SELECT * FROM classes WHERE ClassID='".$classid."'";
		$result2 = mysql_query($query2) or die(mysql_error());
		
		echo "<dl>";
		while($row2 = mysql_fetch_array($result2)){
			echo "<dt><a href=\"javascript:loadXMLDoc('class.php?classID=".$classid."')\">".htmlentities($row2['CourseName']." ".$row2['ClassName'])."</a></dt>";
		}
		echo "</dl>";
	}
?>