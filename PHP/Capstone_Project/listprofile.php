<?php
	$link = mysql_connect('127.0.0.1:3306', 'root', '');
    mysql_select_db("capstone");
	$i = 0;
	$skillarr = explode(" ", $_POST['skill']);
   
	$filter = array();
	
	foreach ($skillarr as $skill) {
		$query = "SELECT * FROM profile WHERE Skills LIKE '%".$skill[$i]."%'";
		$result = mysql_query($query) or die(mysql_error());
		
		while($row = mysql_fetch_array($result)){
			$filter[] = htmlentities($row[0]." ".$row[5]." ".$row[6]);
		}
		$i++;
	}
	
	$display = array_unique($filter);
	
	echo "<dl>";
	foreach ($display as $value) {
		$o = explode(" ",$value);		
		echo "<dt><a href=\"javascript:loadXMLDoc('profile.php?profileID=".htmlentities($o[0])."')\">".htmlentities($o[1]." ".$o[2])."</a></dt>";
	}
	echo "</dl>";
?>

