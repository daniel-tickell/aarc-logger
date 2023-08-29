<html>

<table>

<?php
include 'adif_parser.php';

$p = new ADIF_Parser;

$p->feed("ADIF File as String");

$p->load_from_file($fname);

$p = new ADIF_Parser;
$p->load_from_file("test.adi");
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
?>

<style>
	#qsos {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 60%;
  text-align: center;
}

#qsos td, #qsos th {
  border: 1px solid #ddd;
  padding: 8px;
}

#qsos tr:nth-child(even){background-color: #f2f2f2;}

#qsos tr:hover {background-color: #ddd;}

#qsos th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
