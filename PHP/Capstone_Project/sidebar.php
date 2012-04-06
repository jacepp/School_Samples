<?php
//for now, assuming student. will modify once we have the other pages up and
//the authentication
$con = mysql_connect("localhost");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("capstone", $con);
  $arr = array();
  $results = mysql_query("SELECT ClassID FROM classusers WHERE Classusers.UserID = 3");
  $i = 0;
  while($row = mysql_fetch_array($results))
  {
  $arr[$i] = $row['ClassID'] . " ";
  $i++;
  }
  
  foreach ($arr as $key => $id)
  {
	$results = mysql_query("SELECT AssignID FROM classass WHERE Classass.classID = $id");
	//for now am dumping all homework into this area
	while($row = mysql_fetch_array($results))
	{
		$s = $row['AssignID'] . " ";
		$results = mysql_query("SELECT AssignName, DueDate FROM Assignments WHERE Assignments.AssignID = $s AND uploaddate > Date_Sub(NOW(), INTERVAL 7 DAY) Order By UploadDate LIMIT 0,3");
		while($row = mysql_fetch_array($results))
		{
		echo $row['AssignName'] . "&nbsp " . $row['DueDate'] . "<br/>";
		}
		
	}
	
  }
  mysql_close($con);
?>