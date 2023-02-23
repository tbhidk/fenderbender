<!DOCTYPE html>
<html>   
  <head>  
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>test</title>   
    <link rel="stylesheet"  
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
    <style>   
    table {  
        border-collapse: collapse;  
    }  
        .inline{   
            display: inline-block;   
            float: right;   
            margin: 20px 0px;   
        }   
         
        input, button{   
            height: 34px;   
        }   
  
    .pagination {   
        display: inline-block;   
    }   
    .pagination a {   
        font-weight:bold;   
        font-size:18px;   
        color: black;   
        float: left;   
        padding: 8px 16px;   
        text-decoration: none;   
        border:1px solid black;   
    }   
    .pagination a.active {   
            background-color: pink;   
    }   
    .pagination a:hover:not(.active) {   
        background-color: gold;   
    }   
        </style>   
  </head>   
  <body>
      <p>Goto <a href=testData.php>data </a>directly</p>   
  <center>  
    <?php
    // Import the file where we defined the connection to Database.
    require_once "connection.php";

    $page = "";
    $per_page_record = 10; // Number of entries to show in a page.

    // Look for a GET variable page if not found default is 1.
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page_record;

    $query = "SELECT * FROM `sensordata` LIMIT $start_from, $per_page_record";
    $rs_result = mysqli_query($conn, $query);
    ?>    
  
    <div class="container">   
      <br>   
      <div>   
        <h1>Ship berth history</h1>   
        <p>Ship history described here.   
        </p>
        <div class="table-responsive"> 
        <table class="table table-striped table-condensed    
                                          table-bordered">   
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
  
     <div class="pagination">    
      <?php
      $query = "SELECT COUNT(*) FROM `SensorData`";
      $rs_result = mysqli_query($conn, $query);
      $row = mysqli_fetch_row($rs_result);
      $total_records = $row[0];

      echo "</br>";
      // Number of pages required.
      $total_pages = ceil($total_records / $per_page_record);
      $pagLink = "";

      if ($page >= 2) {
          echo "<a href='index.php?page=" . ($page - 1) . "'>  Prev </a>";
      }

      for ($i = 1; $i <= $total_pages; $i++) {
          if ($i == $page) {
              $pagLink .=
                  "<a class = 'active' href='index.php?page=" .
                  $i .
                  "'>" .
                  $i .
                  " </a>";
          } else {
              $pagLink .=
                  "<a href='index.php?page=" .
                  $i .
                  "'>   
                                                " .
                  $i .
                  " </a>";
          }
      }
      echo $pagLink;

      if ($page < $total_pages) {
          echo "<a href='index.php?page=" . ($page + 1) . "'>  Next </a>";
      }
      ?>    
      </div>  
  
      <div class="inline">   
      <input id="page" type="number" min="1" max="<?php echo $total_pages; ?>"   
      placeholder="<?php echo $page . "/" . $total_pages; ?>" required>   
      <button onClick="go2Page();">Go</button>   
     </div>
    </div>
  </div>
</center>
  <script>
    function go2Page()   
    {   
        var page = document.getElementById("page").value;   
        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
        window.location.href = 'index1.php?page='+page;   
    }
  </script>  
  </body>   
</html>