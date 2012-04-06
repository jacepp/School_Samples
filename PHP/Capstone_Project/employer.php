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
if(flag == "edit")
{
xmlhttp.open("POST","companyinfo.php",true);
xmlhttp.send();
}
else if(flag == "info"){

var contents = 'submit=true&name=' + document.getElementById('name').value+'&address1=' + document.getElementById('address1').value+'&address2=' + document.getElementById('address2').value+'&city=' + document.getElementById('city').value+'&state=' + document.getElementById('state').value+'&phone=' + document.getElementById('phone').value+'&description=' + document.getElementById('description').value;

xmlhttp.open("POST","processinfo.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(contents);
}
else if(flag == "browse")
{
xmlhttp.open("POST","browseprofile.php",true);
xmlhttp.send();
}
else if(flag == "populate")
{
xmlhttp.open("POST","listprofile.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("skill=" + document.getElementById("searchskill").value);
}
else if(flag.substring(0,22) == "profile.php?profileID="){
xmlhttp.open("POST",flag,true);
xmlhttp.send();
}

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" type="text/css" href="style.css" /> 
<title>Employer Home Page</title> 
</head> 
<body> 
        <div id="outer_wrapper"> 
                <div id="wrapper"> 
                        <div id="header"> 
                                <h2>HEAD</h2> 
                                <p>Employer Page</p> 
                        </div><!--header--> 
                        <div id="container"> 
                                <div id="left"> <h2>Left Column</h2> 
                                        <a href = "javascript:loadXMLDoc('browse')">Browse Profiles</a><br /> 
                                        <a href = "">Post Project</a><br /> 
                                        <a href = "javascript:loadXMLDoc('edit')">Edit Company Info</a><br /> 
                                </div><!--left--> 
                                <div id="main"> 
                                        <h2>Center Column</h2> 
                                        <img src="Random.jpg" alt="Picture of something" /> 
                                        <p>This is the center</p> 
                                </div><!--main--> 
                                <div class="clearing"></div> 
                        </div><!--container--> 
                        <div id="right"> 
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
                        </div><!--right--> 
                        <div class="clearing"></div> 
                        <div id="footer"> 
                            <p>footer</p> 
                        </div><!--footer--> 
                </div><!--wrapper--> 
        </div><!--outer_wrapper--> 
</body> 
</html> 