<?php
if(isset($_POST['submit'])){

	$link = mysql_connect('127.0.0.1:3306', 'root', '');
	$db_selected = mysql_select_db("capstone");
	if (!$db_selected) {
    die ('Could not connect: ' . mysql_error());
	}
	
	$check2 = "SELECT OrgID FROM organization WHERE OrgID=0";
	
	$companyName = $_POST['name'];
	$companyAdd1 = $_POST['address1'];
	$companyAdd2 = $_POST['address2'];
	$companyCity = $_POST['city'];
	$companyState = $_POST['state'];
	$companyPhone = $_POST['phone'];
	$companyDesc = $_POST['description'];

	$check = mysql_query($check2, $link) or die("Couldn't execute referral check query.<br>".mysql_error());
	
	if(mysql_num_rows($check) < 1){
		echo "Shit has been added to the database!";
		mysql_query("INSERT INTO organization (Name, Address1, Address2, City, State, Phone, Description)
		VALUES ('$companyName', '$companyAdd1', '$companyAdd2', '$companyCity', '$companyState', '$companyPhone', '$companyDesc')");
	} else { 
		$query = mysql_query("UPDATE organization SET Name='$companyName', Address1='$companyAdd1', Address2='$companyAdd2', City='$companyCity', State='$companyState', Phone='$companyPhone', Description='$companyDesc' WHERE OrgID=4");
		echo "Organization information has been updated!"; }
	
} else { echo "poop";}
?>