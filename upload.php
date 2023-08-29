<?php
include 'adif_parser.php';
include_once("config.php");

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

  $p = new ADIF_Parser;
  $p->load_from_file($target_file);
  $p->initialize();

    echo '<table id="qsos">'.
         '<tr>
            <th>Time</th>
            <th>My Callsign</th>
            <th>My grid</th>
            <th>Dest Callsign</th>
            <th>Dest Grid</th>
            <th>Band</th>
            <th>Frequency</th>
            <th>Mode</th>
            <th>Date</th>
          <tr>';

  while($row = $p->get_record())
  {
    if(count($row) == 0)
    {
      break;
    };

    $format_time = $row["time_on"][0].$row["time_on"][1].":".$row["time_on"][2].$row["time_on"][3].":".$row["time_on"][4].$row["time_on"][5];
    $format_date = $row["qso_date"][0].$row["qso_date"][1].$row["qso_date"][2].$row["qso_date"][3]."-".$row["qso_date"][4].$row["qso_date"][5]."-".$row["qso_date"][6].$row["qso_date"][7];

    $sql = "insert into log_test (src_callsign, grid, dst_callsign, dst_grid,  band, mode, freq, timestamp, date, time)
VALUES ('".$row["station_callsign"]."', '".$row["my_gridsquare"]."', '".$row["call"]."', '".$row['gridsquare']."', '".$row['band']."', '".$row['mode']."', '".$row['freq']."', CURRENT_TIMESTAMP, '".$format_date."', '".$format_time."')";
echo $sql;

if (!mysqli_query($mysqli, $sql)) {
  die('An error occurred when Inserting to the database.');
} else {
    echo "The following records have been inserted";
}

      echo "<tr><td> " . $format_time . 

           "</td><td> " . $row["station_callsign"]. 
           "</td><td> " . $row["my_gridsquare"].
           "</td><td> " . $row["call"]. 
           "</td><td> " . $row["gridsquare"].
           "</td><td> " . $row["band"].
           "</td><td> " . $row["freq"].
           "</td><td> " . $row["mode"].
           "<td> " . $format_date. 

                "</td><tr>";

  };

}

?>
