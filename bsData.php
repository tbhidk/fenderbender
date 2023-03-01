<!DOCTYPE html>
<html>
<head>  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>berthing history</title>   

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  </head>
    <body>
        <h4><a href="">Homepage</a></h4>
        <?php
        require_once "connection.php";
        $sql = "SELECT id, sensor, location, sensor1, sensor2, sensor3, reading_time FROM sensordata ORDER BY id DESC";
    
        echo '<table cellspacing="5" cellpadding="5" testTable>
            <tr> 
                <td>ID</td> 
                <td>Sensor</td> 
                <td>Location</td> 
                <td>Value 1</td> 
                <td>Value 2</td>
                <td>Value 3</td> 
                <td>Timestamp</td> 
            </tr>
            </table>';
        
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
    </body>
</html>