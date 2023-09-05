<?php
include_once("config.php");

if(isset($_POST['Submit'])){ // Fetching variables of the form which travels in URL
        $callsign = strtoupper($_POST['callsign']);
        $grid = strtoupper($_POST['grid']);
        $dst_callsign = strtoupper($_POST['dst_callsign']);
        $dst_grid = strtoupper($_POST['dst_grid']);

        $mode = $_POST['mode'];
        $freq = $_POST['freq'];
        $date = $_POST['date'];
        $time = 'CURRENT_TIMESTAMP';
        if (!$date){
                $date = 'CURRENT_TIMESTAMP';
        }
}

if ($freq >= 1.8 && $freq <= 2.0){
        $band = '160m';
}
else if ($freq >= 3.5 && $freq < 4.0){
        $band = '80m';
}
else if ($freq >= 5.3 && $freq <= 5.405){
        $band = '60m';
}
else if ($freq >= 7 && $freq <= 7.3){
        $band = '40m';
}
else if ($freq >= 10.1 && $freq <= 10.150){
        $band = '30m';
}
else if ($freq >= 14.000 && $freq <= 14.350){
        $band = '20m';
}
else if ($freq >= 18.068 && $freq <= 18.168){
        $band = '17m';
}
else if ($freq >= 21 && $freq <= 21.450){
        $band = '15m';
}
else if ($freq >= 24.890 && $freq <= 24.990){
        $band = '12m';
}
else if ($freq >= 28 && $freq <= 29.7){
        $band = '10m';
}
else if ($freq >= 50 && $freq <= 54){
        $band = '6m';
}
else if ($freq >= 144 && $freq <= 148){
        $band = '2m';
}
else if ($freq >= 219 && $freq <= 225){
        $band = '1.25m';
}
else if ($freq >= 420 && $freq <= 450){
        $band = '70cm';
}
else if ($freq >= 902 && $freq <= 928){
        $band = '33cm';
}
else if ($freq >= 1240 && $freq <= 1300){
        $band = '23cm';
}
else {
        $band = "Out of Ham Band";
}


$sql = "insert into log_test (src_callsign, grid, dst_callsign, dst_grid,  band, mode, freq, timestamp, date, time)
VALUES ('$callsign', '$grid', '$dst_callsign', '$dst_grid', '$band', '$mode', '$freq', CURRENT_TIMESTAMP, '$date', CURRENT_TIMESTAMP)";

if (!mysqli_query($mysqli, $sql)) {
        die('Something Went Wrong inserting your record into the database' . $sql);
} else {
    echo "Record Inserted";
}

header('Location: index.php?call='. $callsign . "&grid=" . $grid . "&freq=" . $freq . "&mode=" . $mode);

?>
