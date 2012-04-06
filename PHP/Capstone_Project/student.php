<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http:// 
www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<script type="text/javascript">
function loadXMLDoc(flag)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("main").innerHTML=xmlhttp.responseText;
    }
  }
if(flag == "j")
{
xmlhttp.open("POST","joinclass.html",true);
xmlhttp.send();
}
else if(flag == "jc"){
xmlhttp.open("POST","bridge.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("selection=" + document.getElementById("selection").value);
}
else if(flag == "lc"){
xmlhttp.open("POST","listclasses.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
}
else if(flag.substring(0,18) == "class.php?classID="){
xmlhttp.open("POST",flag,true);
xmlhttp.send();
}
else if(flag == "ep")
{
xmlhttp.open("POST","editprofile.php",true);
xmlhttp.send();
}
else if(flag == "rc")
{
xmlhttp.open("POST","rateclass.php",true);
xmlhttp.send();
}
else if(flag == "rt")
{
xmlhttp.open("POST","rateteacher.php",true);
xmlhttp.send();
}
else if(flag.substring(0,24) == "assignments.php?classID="){
xmlhttp.open("POST",flag,true);
xmlhttp.send();
}

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" type="text/css" href="style.css" /> 
<title>Student Home Page</title> 
</head> 
<!-- 
include("include/session.php");
if($session->logged_in){
require_once('page.php');
	
	$studentPage = new page();
	$studentPage->DisplayHeader();
-->

<body> 
<div id="outer_wrapper"> 
        <div id="wrapper"> 
                <div id="header"> 
                        <h2>Header</h2> 
                        <p>...</p> 
                </div><!-- /header --> 
        <div id="container"> 
                <div id="left"> 
                        <h1>Left</h1> 
                        <ol> 
                        <li><a href="javascript:loadXMLDoc('lc')">My Classes</a></li> 
                        <li><a href="javascript:loadXMLDoc('j')">Join Classes</a></li> 
                        <li><a href="javascript:loadXMLDoc('ep')">Edit Profile</a></li> 
                        <li><a href="javascript:loadXMLDoc('rc')">Rate Class</a></li> 
                        <li><a href="javascript:loadXMLDoc('rt')">Rate Instructor</a></li> 
                        </ol> 
                </div><!-- /left --> 
                <div id="main"> 
                        <h1>Main</h1> 
            <img src="33.jpg" alt="Cock"/> 
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed 
molestie mauris id wisi. Morbi nisl urna, sollicitudin vitae, mattis 
non, sagittis eu, mauris. Nulla tellus. In faucibus mi id lorem. 
Quisque quis tortor et odio scelerisque consequat. Vestibulum ante 
ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
Curae& Proin Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
Sed molestie mauris id wisi. Morbi nisl urna, sollicitudin vitae, 
mattis non, sagittis eu, mauris. Nulla tellus. In faucibus mi id 
lorem. Quisque quis tortor et odio scelerisque consequat. Vestibulum 
ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
Curae& Proin Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
Sed molestie mauris id wisi. Morbi nisl urna, sollicitudin vitae, 
mattis non, sagittis eu, mauris. Nulla tellus. In faucibus mi id 
lorem. Quisque quis tortor et odio scelerisque consequat. Vestibulum 
ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
Curae& Proin. Lorem ipsum dolor sit amet, consectetuer adipiscing 
elit. Sed molestie mauris id wisi. Morbi nisl urna, sollicitudin 
vitae, mattis non, sagittis eu, mauris. Nulla tellus. In faucibus mi 
id lorem. Quisque quis tortor et odio scelerisque consequat. 
Vestibulum ante ipsum primis in faucibus orci luctus et ultrices 
posuere cubilia Curae& Proin.<br /><br /> Lorem ipsum dolor sit amet, 
consectetuer adipiscing elit. Sed molestie mauris id wisi. Morbi nisl 
urna, sollicitudin vitae, mattis non, sagittis eu, mauris. Nulla 
tellus. In faucibus mi id lorem. Quisque quis tortor et odio 
scelerisque consequat. Vestibulum ante ipsum primis in faucibus orci 
luctus et ultrices posuere cubilia Curae& Proin. Lorem ipsum dolor sit 
amet, consectetuer adipiscing elit. Sed molestie mauris id wisi. Morbi 
nisl urna, sollicitudin vitae, mattis non, sagittis eu, mauris. Nulla 
tellus. In faucibus mi id lorem. Quisque quis tortor et odio 
scelerisque consequat. Vestibulum ante ipsum primis in faucibus orci 
luctus et ultrices posuere cubilia Curae& Proin. Lorem ipsum dolor sit 
amet, consectetuer adipiscing elit. Sed molestie mauris id wisi. Morbi 
nisl urna, sollicitudin vitae, mattis non, sagittis eu, mauris. Nulla 
tellus. In faucibus mi id lorem. Quisque quis tortor et odio 
scelerisque consequat. Vestibulum ante ipsum primis in faucibus orci 
luctus et ultrices posuere cubilia Curae& Proin. Lorem ipsum dolor sit 
amet, consectetuer adipiscing elit. Sed molestie mauris id wisi. Morbi 
nisl urna, sollicitudin vitae, mattis non, sagittis eu, mauris. Nulla 
tellus. In faucibus mi id lorem. Quisque quis tortor et odio 
scelerisque consequat. Vestibulum ante ipsum primis in faucibus orci 
luctus et ultrices posuere cubilia Curae& Proin.<br /><br /> Lorem 
ipsum dolor sit amet, consectetuer adipiscing elit. Sed molestie 
mauris id wisi. Morbi nisl urna, sollicitudin vitae, mattis non, 
sagittis eu, mauris. Nulla tellus. In faucibus mi id lorem. Quisque 
quis tortor et odio scelerisque consequat. Vestibulum ante ipsum 
primis in faucibus orci luctus et ultrices posuere cubilia Curae& 
Proin. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed 
molestie mauris id wisi. Morbi nisl urna, sollicitudin vitae, mattis 
non, sagittis eu, mauris. Nulla tellus. In faucibus mi id lorem. 
Quisque quis tortor et odio scelerisque consequat. Vestibulum ante 
ipsum primis in faucibus orci luctus et ultrices posuere cubilia 
Curae& Proin. Lorem ipsum dolor sit amet, consectetuer adipiscing 
elit. Sed molestie mauris id wisi. Morbi nisl urna, sollicitudin 
vitae, mattis non, sagittis eu, mauris. Nulla tellus. In faucibus mi 
id lorem. Quisque quis tortor et odio scelerisque consequat. 
Vestibulum ante ipsum primis in faucibus orci luctus et ultrices 
posuere cubilia Curae& Proin.</p> 
                </div><!-- /main --> 
                <!-- This is for NN6 --> 
                <div class="clearing"> </div> 
            </div><!-- /container -->
                <div id="right"> 
                        <h1>Updates</h1> 
						<div id="profile">
                        <!-- This is where updates in your classes will go
							This script should check the DB for your classes, and then
							check for recent activity by 3 categories. Homework, DB posts, and messages
							-->
							Welcome back, User! <br/>
							<img src="silhouette.gif" alt="no user pic defined" id='profilepic' />
							<br/><br/><br/><br/><br/><br/><br/>
							<!-- script for messages goes here -->
							Unread Messages: 0 | Send Message<br/><br/>
							<?php
							include 'sidebar.php';
							?>
							</div>
                </div><!-- /sidebar -->  
                <!-- This is for NN4 --> 
                <div class="clearing"> </div> 
                <div id="footer"> 
                        <h2>Footer</h2> 
                        <p>...</p> 
                </div><!-- /footer --> 
		
        </div><!-- /wrapper --> 
</div><!-- /outer_wrapper --> 
<!--
}
else{
	header("Location: login.php");
}
?>
-->
</body> 
</html> 