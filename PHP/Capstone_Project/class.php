<?php
$classid = $_GET['classID'];

$con = mysql_connect("localhost");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("capstone", $con);
  $results = mysql_query("SELECT * FROM classes where Classes.classID = " . $classid . "");
  while($row = mysql_fetch_array($results))
  {
	$name = $row['ClassName'];
	$cname = $row['CourseName'];
	}
	echo '<h1>' . $cname . ' - ' . $name . '</h1><br/>';
	echo 'Welcome to the class page. there will be more stuff here!<br/>';
	echo "<a href=\"javascript:loadXMLDoc('assignments.php?classID=" . $classid . "')\">Homework Assignments</a><br/>";
	echo '<a href="javascript:loadXMLDoc("boards.php?classID=' . $classid . '")">Discussion Boards</a><br/>';
	echo "<a href=\"javascript:loadXMLDoc('contactT.php?classID=" . $classid ."')\">Contact Instructor</a><br/>";