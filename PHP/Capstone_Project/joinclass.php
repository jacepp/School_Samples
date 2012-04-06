<html>
<body>

<h1>Join A Class</h1>

<?php
echo "<label>Select A Course:</label>";
    echo"<form action=\"joinclass.php\" method=\"post\">";
      echo"<SELECT name=\"selection\" size=3>";
        echo"<OPTION value=\"GE\">GE - General Education</OPTION>";
        echo"<OPTION value=\"TB\">TB - Technical Basic</OPTION>";
        echo"<OPTION value=\"EG\">EG - Economic Growth</OPTION>";
        echo"<OPTION value=\"CS\">CS - Computer Science</OPTION>";
        echo"<OPTION value=\"IT\">IT - Information Technology</OPTION>";
        echo"<OPTION value=\"ET\">ET - Electronics Engineering</OPTION>";
        echo"<OPTION value=\"CD\">CD - Computer Drafting and Design</OPTION>";
        echo"<OPTION value=\"VC\">VC - Visual Communication</OPTION>";
        echo"<OPTION value=\"CJ\">CJ - Criminal Justice</OPTION>";
        echo"<OPTION value=\"PL\">PL - Paralegal</OPTION>";
        echo"<OPTION value=\"NU\">NU - Nursing</OPTION>";
      echo"</SELECT>";
	    echo"<br /><br />";
      echo"<input type=\"submit\" name=\"selected\" value=\"Select\" />";
	echo"</form>";
  
  if(isset($_POST['selection'])){
  
	echo "<form action=\"joinclass.php\" method=\"post\">";
    
	$courseID = $_POST['selection'];
	
    $link = mysql_connect("localhost");
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
  } 
  // if(isset($_POST['joinclass'])){
	// $link = mysql_connect("localhost", "root", "");
    // mysql_select_db("sampleclasses");
	// $classID = "SELECT * FROM Classes WHERE CourseID='".$courseID."'";
  
    // mysql_query("UPDATE ClassUsers SET ClassID='".$classID."' WHERE =''");
	
	// echo "Joined"." ".$_POST['joinclass'];	
  // }
?>
</body>
</html>
