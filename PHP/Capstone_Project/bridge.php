<?php
if(isset($_POST['selection'])){
	echo "<h1>Join A Class</h1>";
	echo "<form action=\"joinclass.php\" method=\"post\">";
	$courseID = $_POST['selection'];
	
    $link = mysql_connect('127.0.0.1:3306', 'root', '');
    mysql_select_db("capstone");
    
	$query = "SELECT * FROM Classes WHERE CourseID='".$courseID."'";
    $result = mysql_query($query);
    $row = "";
	
		if(!$result = mysql_query($query)){
			die("Nope.");
		}
		if(mysql_num_rows($result) > 0){
			echo "<select name=\"joinclass\" width=\"300px\" size=10>";
			while($row = mysql_fetch_array($result)){
				echo "<option value=\"".htmlentities($row['CourseName'])."\" selected=\"selected\">".htmlentities($row['CourseName']." ".$row['ClassName']." ".$row['Term']." ".$row['Year'])."</option>";
			}
			echo "</select><br/>";
			} else {
				echo "Nope.<br/>";
				}
		mysql_close($link);
	echo "<br />";
	echo "<input type=\"submit\" name=\"joined\" value=\"Join\" />";
	echo "</SELECT>";
	echo "</form>";
//  } 
  // if(isset($_POST['joinclass'])){
	// $link = mysql_connect("localhost", "root", "");
    // mysql_select_db("sampleclasses");
	// $classID = "SELECT * FROM Classes WHERE CourseID='".$courseID."'";
  
    // mysql_query("UPDATE ClassUsers SET ClassID='".$classID."' WHERE =''");
	
	// echo "Joined"." ".$_POST['joinclass'];	
   }
   
?>