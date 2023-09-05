<?php
include_once("config.php");
//setting header to json
header('Content-Type: application/json');


$result = mysqli_query($mysqli, "select grid as grid, count(*) as contacts from log_test group by 1 order by 2 desc");

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>
