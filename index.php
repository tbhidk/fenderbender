<!DOCTYPE html>
<html>   
  <head>  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>test</title>
  
  <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  </head>  

  <body>
    <div id="test">
    <ul class="nav nav-list">
      <li class="active"><a href="#"><i class="icon-home icon-white"></i> Home</a></li>
      <li><a href="#"><i class="icon-book"></i> Library</a></li>
      <li><a href="#"><i class="icon-pencil"></i> Applications</a></li>
      <li><a href="bsData.php"><i class="i"></i> Misc</a></li>
    </ul>
    </div>
      <p>
        <a class="btn btn-primary" href=testData.php>goto data directly</a>
      </p>   
  
    <div class="container">   
      <br>   
      <div>   
        <h1>Ship berth history</h1>   
        <p>Here are the lists of ship that berthed here.</p>
        <div class="table-responsive">
          <table id="tabel-data" style="width:100%">
            <thead>
              <tr>   
                <th width="10%">No.</th>   
                <th>Location</th>   
                <th>Value 1</th>
                <th>Value 2</th>
                <th>Value 3</th>
                <th width="1%">Available</th>
              </tr>   
            </thead>
            <tbody>
              <?php
              include "connection.php";
              $query = "SELECT * FROM `sensordata`";
              $rs_result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_array($rs_result)) {
                // Display each field of the records.
                echo '<tr>';     
                echo '<td>' . $row["id"] . '</td>';    
                echo '<td>' . $row["location"] . '</td>'; 
                echo '<td>' . $row["sensor1"] . '</td>';       
                echo '<td>' . $row["sensor2"] . '</td>';       
                echo '<td>' . $row["sensor3"] . '</td>';
                echo '<td>' . $row["ship_available"] . '</td>';       
                echo '</tr>';
              };
              ?>     
          </tbody>   
        </table> 
    </div>
  </div>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
  
  </body>   
</html>