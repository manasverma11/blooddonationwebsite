<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<?php
include 'header.php';
    require '../php/dbconn.php';

    if (mysqli_connect_error())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $result = mysqli_query($con, "SELECT * FROM jhtml ORDER BY id ASC");

      ?>
<table class="table table-dark">
<tr><td colspan="12">        <?php if($_REQUEST['info'] == "delete"){?>
                <p class="alert alert-danger d-flex justify-content-center" role="alert">
                    Record has been deleted successfully!
                </p>
            <?php }?></td></tr>
    <tr>
        <td colspan="12" class="text-center"><h4>Web Developer Job Applicant</h4></td>
    </tr>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">City</th>
      <th scope="col">Zip Code</th>
      <th scope="col">Exprience</th>
      <th scope="col">Qualification</th>
      <th scope="col">Telephone</th>
      <th scope="col">CV or Resume</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if ($result->num_rows > 0){
        while ($row = mysqli_fetch_array($result))
        {
          echo "<tr><td>".$row['id']."</td><td>".ucwords(strtolower($row['fullname']))."</td><td>".$row['email']."</td><td>".$row['address']."</td><td>".ucwords(strtolower($row['city']))."</td><td>".$row['zip']."</td><td>".$row['exp']."</td><td>".$row['qua']."</td><td>".$row['tel']."</td><td><a href='../cv/".$row['cv']."' download type='button' class='btn btn-primary'>Download</a></td><td><a href='logic.php?delhtml=".$row['id']."' type='button' class='btn btn-danger'>Delete</a></td></tr>\n";
      }
        ?>
  </tbody>
</table>
<?php

mysqli_close($con);
    }
?>