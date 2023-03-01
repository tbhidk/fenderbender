<!DOCTYPE html>
<html>
<head>  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>berthing history</title>   
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css">

    <!--
      <link rel="stylesheet"  
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     -->  

  </head>
  <body>
  <h4>
    <a href="./">Homepage</a>
  <div id="test">
    <ul class="nav nav-list">
      <li><a href=index.php><i class="icon-home icon-white"></i> Home</a></li>
      <li class="active"><a href="#"><i class="icon-book"></i> Data</a></li>
      <li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
      <li><a href="#"><i class="i"></i> Misc</a></li>
    </ul>
    </div>
<?php

require_once "connection.php";
$sql = "SELECT id, sensor, location, sensor1, sensor2, sensor3, reading_time FROM sensordata ORDER BY id DESC";

echo '<table cellspacing="5" cellpadding="5">
      <tr> 
        <td>ID</td> 
        <td>Sensor</td> 
        <td>Location</td> 
        <td>Value 1</td> 
        <td>Value 2</td>
        <td>Value 3</td> 
        <td>Timestamp</td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_location = $row["location"];
        $row_sensor1 = $row["sensor1"];
        $row_sensor2 = $row["sensor2"]; 
        $row_sensor3 = $row["sensor3"]; 
        $row_reading_time = $row["reading_time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 7 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_sensor . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_sensor1 . '</td> 
                <td>' . $row_sensor2 . '</td>
                <td>' . $row_sensor3 . '</td> 
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
</body>
</html>