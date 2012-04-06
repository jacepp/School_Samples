<?php
$link = mysql_connect('127.0.0.1:3306', 'root', '');
$db_selected = mysql_select_db("capstone");
if (!$db_selected) {
    die ('Could not connect: ' . mysql_error());
}
//OrgID needs to be replaced with UseID or some sort of SessionID
$query = "SELECT * FROM organization WHERE OrgID=0";
$check = mysql_query($query, $link);
$result = mysql_query($query);

if(mysql_num_rows($check) < 1){
	$companyName = "";
	$companyAdd1 = "";
	$companyAdd2 = "";
	$companyCity = "";
	$companyState = "";
	$companyPhone = "";
	$companyDesc = "";
} else {
	while($row = mysql_fetch_array($result)){
		$companyName = htmlentities($row['Name']);
		$companyAdd1 = htmlentities($row['Address1']);
		$companyAdd2 = htmlentities($row['Address2']);
		$companyCity = htmlentities($row['City']);
		$companyState = htmlentities($row['State']);
		$companyPhone = htmlentities($row['Phone']);
		$companyDesc = htmlentities($row['Description']);
	}
}
?>

</html>
<head>
</head>
<body>
<div align="center">
	<form action="javascript:loadXMLDoc('info')" id="editinfo" name="editinfo" method="POST">
		<table>
			<tr>
				<td colspan="2" class="labelcell">Name:</td>
				<td colspan="2" class="fieldcell"><input type="text" name="name" id="name" value="<?php echo $companyName; ?>" size="20"></td>
			</tr>
			<tr>
				<td colspan="2" class="labelcell">Address 1:</td>
				<td colspan="2" class="fieldcell"><input type="text" name="address1" id="address1" value="<?php echo $companyAdd1; ?>" size="20"></td>
			</tr>
			<tr>
				<td colspan="2" class="labelcell">Address 2:</td>
				<td colspan="2" class="fieldcell"><input type="text" name="address2" id="address2" value="<?php echo $companyAdd2; ?>" size="20"></td>
			</tr>
			<tr>
				<td colspan="2" class="labelcell">Phone:</td>
				<td colspan="2" class="fieldcell"><input type="text" name="phone" id="phone" value="<?php echo $companyPhone; ?>" size="20"></td>
			</tr>
			<tr>
				<td class="smalllabelcell"><label for="state">State</label></td>    
				<td class="smallfieldcell"><select name="state" id="state" tabindex="5">    
					<option value="">-- Select ---</option>    
					<option value="AL" >Alabama</option>    
					<option value="AK" >Alaska</option>    
				  </select></td>
				<td class="smalllabelcell">City:</td>
				<td class="smallfieldcell"><input type="text" name="city" id="city" value="<?php echo $companyCity; ?>" size="20"></td>
			</tr>
			<tr>
				<td colspan="4" class="labelcell">Description:<br />
				<textarea name="description" id="description" cols="55" rows="10"><?php echo $companyDesc; ?></textarea></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><input type="submit" /></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>