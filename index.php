<html>

<meta name="viewport" content="width=device-width" />
<section class="layout">
  
<div class="header">
    <center>
    <h1>AARC GOTA Logging</h1>
    <title>AARC GET ON THE AIR!</title>
  </center>
</div>

<div class="leftSide">
<table>
<form action="insert.php" method="POST">
<tr>
  <td><label for="callsign">My Callsign</label>        </td>
  <td><input type="text" name="callsign" id="callsign" required> </td>
</tr>

 <tr>
  <td><label for="grid">My Grid</label></td>
  <td><input type="text" name="grid" id="grid" required pattern="(?:[a-zA-Z]{2}[0-9]{2}[a-zA-Z]{0,2})"></td>

 <tr>
  <td><label for="dst_callsign">Other Side Call</label></td>
 <td><input type="text" name="dst_callsign" id="dst_callsign" required></td>

<tr>
  <td><label for="dst_grid">Other Side Grid</label></td>
 <td><input type="text" name="dst_grid" id="dst_grid" required></td>

</tr>
  <td><label for="mode">Mode</label></td>
  <td><select name="mode" id="mode" required>
  <option value="Voice">Voice</option>
  <option value="CW">CW</option>
  <option value="DMR">DMR</option>
  <option value="DSTAR">Dstar</option>
  <option value="fusion">fusion</option>
  <option value="Digital Data">Digital Data (FT8, RTTY etc)</option>
  <option value="Other">Other</option>
</select></td>
<tr>
 <td><label for="freq">Frequency (Mhz.Khz)</label></td>
 <td><input type="text" name="freq" id="freq" required pattern="(?:[0-9]{1,4}\.[0-9]{1,4})"></td>

<tr>
 <td><label for="date">Date</label></td>
 <td><input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>"></td>
<tr>
  <td><input type="submit" value="Submit" name="Submit"></td></tr>
</form>
</table>
</div>


<div class="body">
<?php
include_once("config.php");

global $result;

$result = mysqli_query($mysqli, "SELECT * FROM log_test");

if ($result->num_rows > 0) {
  // output data of each row
  echo '<table id="qsos">'.
      '<tr>
          <th>Entry</th>
          <th>Time</th>
          <th>Callsign</th>
          <th>grid</th>
          <th>Dest Callsign</th>
          <th>Dest Grid</th>
          <th>Band</th>
          <th>Frequency</th>
          <th>Mode</th>
          <th>Date</th>
        <tr>';

  while($row = $result->fetch_assoc()) {
    echo "<tr><td>  " . $row["entry"]. 
         "</td><td> " . $row["time"]. 

         "</td><td> " . $row["src_callsign"]. 
         "</td><td> " . $row["grid"].
         "</td><td> " . $row["dst_callsign"]. 
         "</td><td> " . $row["dst_grid"].
         "</td><td> " . $row["band"].
         "</td><td> " . $row["freq"].
         "</td><td> " . $row["mode"].
        "<td> " . $row["date"]. 

              "</td><tr>";
  }
} else {
  echo "0 results";
}
echo "</table>";

?>


</div>

<div id='footer'>
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select ADIF file to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload ADIF" name="submit">
</form>
</div>

</section>
</html>

<style>

@import url(https://fonts.googleapis.com/css?family=Lato:400,300,100,700,900);

.layout {


  display: grid;
  grid:
    "header header  " auto
    "leftSide body " auto
    "footer footer  " auto;
  gap: 8px;
  grid-auto-flow: row dense;
  grid-template-columns: fit-content(300px) fit-content(1000px);
}

.header { grid-area: header; }
.leftSide { grid-area: leftSide; }
.body { grid-area: body; }
.footer { grid-area: footer; }



h1,
p,
a{
  margin: 0;
  padding: 0;
  font-family: 'Lato';
}

h1 {
  font-size: 2.8em;
  padding: 10px 0;
  font-weight: 800;
}
h2 {
  font-size: 2.8em;
  padding: 10px 0;
  font-weight: 800;
  font-family: 'Lato';
}

p {
  font-size: 1.1em;
  font-weight: 100;
  letter-spacing: 5px;
}

table{
  font-size: 1em;
  padding: 10px 0;
  font-weight: 500;
  font-family: 'Lato';
}

#qsos {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
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


