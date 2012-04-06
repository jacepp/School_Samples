<?php

//if (!empty($_GET['store'])){
 //   $store=$_GET['store'];

//Configure and Connect to the Databse
require_once('connectvars.php');
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Error connecting to MySQL server.');
 //Pull data from home.php front-end page
 $name=$_POST['Name'];
 $score=$_POST['Score'];
 //Insert Data into mysql
$query="INSERT INTO myTable(Name,Score) VALUES('$name','$score')";
if($query){

mysqli_query($dbc, $query); 

// sending query
$result = "SELECT Name, Score FROM myTable ORDER BY Score DESC";
$data = mysqli_query($dbc, $result);
if (!$result) {
    die("Query to show fields from table failed");
}

echo '<table>';
	$i = 0;
	while ($row = mysqli_fetch_array($data)) {
	  //Display score data
	  if ($i == 0){
	    echo '<tr><td colspan ="2" class="topscoreheader">Top Score: ' . $row['Score'] . '</td></tr>';
      echo '<tr><td>Name:</td><td>Score:</td></tr>';
	  }
	  echo '<tr><td class="name">' . $row['Name'] . '</td>';
	  echo '<td>' . $row['Score'] . '</td></tr>';
    if ($i == 10){
        break;
    }
		$i++;
  }
  echo '</table>';
  mysqli_close($dbc);
}
?>
