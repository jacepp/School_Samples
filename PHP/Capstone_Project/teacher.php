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
if(flag == "ua")
{
xmlhttp.open("POST","uploadassignment.php",true);
xmlhttp.send();
}

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" type="text/css" href="style.css" /> 
<title>Student Home Page</title> 
</head>  
<body> 
        <div id="outer_wrapper"> 
                <div id="wrapper"> 
                        <div id="header"> 
                                <h2>HEAD</h2> 
                                <p>Teacher Page</p> 
                        </div><!--header--> 
                        <div id="container"> 
                                <div id="left"> <h2>Left Column</h2> 
                                        <a href = "javascript:loadXMLDoc('ua')">Upload Assignments</a><br /> 
                                        <a href = "">Upload Quiz</a><br /> 
                                        <a href = "">Invite Students</a><br />  
                                        <a href = "">Classes</a> 
                                </div><!--left--> 
                                <div id="main"> 
                                        <h2>Center Column</h2> 
                                        <img src="Random.jpg" alt="Picture of something" /> 
                                        <p>This is the center</p> 
                                </div><!--main--> 
                                <div class="clearing"></div> 
                        </div><!--container--> 
                        <div id="right"> 
                                <h2>Right Column</h2> 
                                <a href = "">Link 1</a><br /> 
                                <a href = "">Link 2</a><br /> 
                                <a href = "">Link 3</a><br /> 
                        </div><!--right--> 
                        <div class="clearing"></div> 
                        <div id="footer"> 
                                <h2>FOOT</h2> 
                                <p>Made by ___________________ <-Our Group name</p> 
                        </div><!--footer--> 
                </div><!--wrapper--> 
        </div><!--outer_wrapper--> 
</body> 
</html> 