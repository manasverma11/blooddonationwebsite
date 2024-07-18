<?php
include 'header.php';
require '../php/dbconn.php';

    if (mysqli_connect_error())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $result = mysqli_query($con, "SELECT * FROM blood_camps ORDER BY id ASC");
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <!-- Display any info -->
     <?php if(isset($_REQUEST['info'])){ ?>
            <?php if($_REQUEST['info'] == "added"){?>
                <div class="alert alert-success" role="alert">
                    Blood Camp Added successfully!
                </div>
            <?php }?>
            <?php if($_REQUEST['info'] == "delete"){?>
                <div class="alert alert-danger" role="alert">
                    Blood Camp deleted successfully!
                </div>
            <?php }?>
            <?php }?>
<p class="h1 text-center">Blood Donation Camp Schedule</p>
<div><a href="add_blood_camps.php" class="btn btn-success ml-3">Add blood camps</a></div>
<table class="table mt-3">
    <thead class="thead-dark">
        <tr>
            <th scope="col">S.no</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Camp Name</th>
            <th scope="col">Address</th>
            <th scope="col">State</th>
            <th scope="col">District</th>
            <th scope="col">Contact</th>
            <th scope="col">Conducted By</th>
            <th scope="col">Organized by</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
  if ($result->num_rows > 0){
        while ($row = mysqli_fetch_array($result))
        {
          echo "<tr><td>".$row['id']."</td><td>".date('d/m/y',strtotime($row['sdate']))." - ".date('d/m/y',strtotime($row['edate']))."</td><td>".date('h:i a',strtotime($row['stime']))." - ".date('h:i a',strtotime($row['etime']))."</td><td>".$row['cname']."</td><td>".$row['cadd']."</td><td>".$row['state']."</td><td>".$row['district']."</td><td>".$row['contact']."</td><td>".$row['conducted']."</td><td>".$row['organized']."</td><td><a href='logic.php?del_blood_camp=".$row['id']."' type='button' class='btn btn-danger'>Delete</a></td></tr>\n";
      }
        ?>
    </tbody>
</table>
<?php

mysqli_close($con);
    }
?>