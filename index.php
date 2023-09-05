<html>

<meta name="viewport" content="width=device-width" />
<section class="layout">
  
<div class="header">
    <center>
    <h1>AARC GOTA Logging</h1>
    <title>AARC GET ON THE AIR!</title>
    <h2>Get On The Air!!</h2>
  </center>
</div>

<div class="leftSide">


<table>
<form action="insert.php" method="POST">
<tr>

  <td><label for="callsign">My Callsign</label></td>
  <td><input type="text" name="callsign" id="callsign" value="<?php if(isset($_GET['call'])) { echo($_GET['call']); } ?>" required> </td>
</tr>

 <tr>
  <td><label for="grid">My Grid</label></td>
  <td><input type="text" name="grid" id="grid" value="<?php if(isset($_GET['grid'])) { echo($_GET['grid']); } ?>" required pattern="(?:[a-zA-Z]{2}[0-9]{2}[a-zA-Z]{0,2})"></td>

 <tr>
  <td><label for="dst_callsign">Other Side Call</label></td>
 <td><input type="text" name="dst_callsign" id="dst_callsign" required></td>

<tr>
  <td><label for="dst_grid">Other Side Grid</label></td>
 <td><input type="text" name="dst_grid" id="dst_grid" required></td>

</tr>
  <td><label for="mode">Mode</label></td>
  <td><select name="mode" id="mode"  required>
  <option value="Voice" <?php if(isset($_GET['mode']) && $_GET['mode'] == 'Voice') { echo('selected');} ?>>Voice</option>
  <option value="CW" <?php if(isset($_GET['mode']) && $_GET['mode'] == 'CW') { echo('selected');} ?>>CW</option>
  <option value="Digi Voice" <?php if(isset($_GET['mode']) && $_GET['mode'] == 'Digi Voice') { echo('selected');} ?>>Digital Voice (DMR, DSTAR, Fusion etc)</option>
  <option value="Digi Data" <?php if(isset($_GET['mode']) && $_GET['mode'] == 'Digi Data') { echo('selected');} ?>>Digital Data (FT8, RTTY etc)</option>
  <option value="Other" <?php if(isset($_GET['mode']) && $_GET['mode'] == 'Other') { echo('selected');} ?>>Other</option>
</select></td>
<tr>
 <td><label for="freq">Frequency (Mhz.Khz)</label></td>
 <td><input type="text" name="freq" id="freq" required pattern="(?:[0-9]{1,4}\.[0-9]{1,4})" value="<?php if(isset($_GET['freq'])) { echo($_GET['freq']); } ?>"></td>

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
  echo 
      '<h3>Search Callsign Field:</h3><input type="text" id="myInput" onkeyup="searchTable()" placeholder="Callsign...">'.
      '<table id="qsos">'.
      '<tr>
          <th onclick="sortTable(0)">Entry</th>
          <th onclick="sortTable(1)">Time</th>
          <th onclick="sortTable(2)">Callsign</th>
          <th onclick="sortTable(3)">grid</th>
          <th onclick="sortTable(4)">Dest Callsign</th>
          <th onclick="sortTable(5)">Dest Grid</th>
          <th onclick="sortTable(6)">Band</th>
          <th onclick="sortTable(7)">Frequency</th>
          <th onclick="sortTable(8)">Mode</th>
          <th onclick="sortTable(9)">Date</th>
        </tr>';

  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["entry"]. 
         "</td><td>" . $row["time"]. 
         "</td><td>" . $row["src_callsign"]. 
         "</td><td>" . $row["grid"].
         "</td><td>" . $row["dst_callsign"]. 
         "</td><td>" . $row["dst_grid"].
         "</td><td>" . $row["band"].
         "</td><td>" . $row["freq"].
         "</td><td>" . $row["mode"].
         "<td>" . $row["date"]. 
         "</td></tr>";
  }
} else {
  echo "0 results";
}
echo "</table>";

?>


</div>

<div id='footer'>
<table>
<tr>
  <td> <h3><a href='stats.html'> Check out our Stats</a></h3> </td>

<tr><td>
If you have been loging using other software, you can Upload an exported ADI file here.
</td></tr>
<tr><td>
<form action="upload.php" method="post" enctype="multipart/form-data">
  <h3>Select ADIF file to upload: </h3>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload ADIF" name="submit">
</form>
</td></tr>
</div>

</section>

<script>
function searchTable() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("qsos");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function sortTable(n) {
  var table, rows, switching, i, x = '', y = '', shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("qsos");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;

 
    for (i = 1; i < rows.length -1; i++ ) {
      shouldSwitch = false;
      nextRow =  (i + 1);

      x = String(rows[i].getElementsByTagName("td")[n].innerHTML).toLowerCase();
      y = String(rows[nextRow].getElementsByTagName("td")[n].innerHTML).toLowerCase();
      
      if (dir == "asc") {
        if (x > y) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x < y) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[nextRow], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
    }

  }
}
}

</script>
</html>

<style>

@import url(https://fonts.googleapis.com/css?family=Lato:400,300,100,700,900);

.layout {


  display: grid;
  grid:
    "header header  " auto
    "leftSide rightSide " auto
    "body body" auto
    "footer footer" auto;

  gap: 8px;
  grid-auto-flow: row dense;
  grid-template-columns: fit-content(300px) fit-content(1000px);
}

.header { 
  grid-area: header; 
  background-color: #04AA6D;
  color: white;
}
.leftSide { 
  grid-area: leftSide; 
}
.rightSide { 
  grid-area: rightSide; 
}
.body { 
  grid-area: body; 
}
.footer { 
  grid-area: footer;
  background-color: #04AA6D;
  color: white;
}



h1,
p,
a{
  margin: 0;
  padding: 0;
  font-family: 'Lato';
}

h1 {
  font-size: 3.8em;
  padding: 10px 0;
  font-weight: 600;
}
h2 {
  font-size: 2.8em;
  padding: 10px 0;
  font-weight: 400;
  font-family: 'Lato';
}
h3 {
  font-size: 1.0em;
  font-weight: 600;
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
