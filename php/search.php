<?php
    $con = new mysqli("localhost","root","","majorproject",'3308');
    $bg = $_GET['search'];
    $_SESSION['search'] = $bg;
    //$query = "SELECT * FROM employees
   // WHERE first_name LIKE '%{$name}%' OR last_name LIKE '%{$name}%'";

    // Check connection
    if (mysqli_connect_error())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $result = mysqli_query($con, "SELECT * FROM donordetails WHERE bg LIKE '%{$bg}%'ORDER BY name ASC");
      if($bg ==null){
        header("location:".$_SERVER['HTTP_REFERER']);
      }
  if($bg == "a+" || $bg == "a-" || $bg == "b+" || $bg == "b-" || $bg == "o+" || $bg == "o-" || $bg == "ab+" || $bg == "ab-"
  ||$bg == "A+" || $bg == "A-" || $bg == "B+" || $bg == "B-" || $bg == "O+" || $bg == "O-" || $bg == "AB+" || $bg == "AB-"|| $bg == "Ab+" || $bg == "Ab-"
  || $bg == "aB+" || $bg == "aB-"){
if ($result->num_rows > 0){
      ?>
  <form action="searchcity.php" method="get" id="searchcity">
      <input type="search" name="searchcity" placeholder="Search City">
      <input type="submit" value="Search">
</form>
    <table>
    <thead>
    <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Blood Group</th>
    <th>City</th>
    <th>Address</th>
    <th>Location</th>
  </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_array($result))
        {
          echo "<tr><td>".ucwords(strtolower($row['name']))."</td><td><a href=".'mailto:'.$row['email'].">".strtolower($row['email'])."</a></td><td>".strtoupper($row['bg'])."</td><td>".ucwords(strtolower($row['city']))."</td><td>{$row['address']}</td><td><a href='https://www.google.com/maps?q={$row['lat']},{$row['lon']}' target='_blank'><img src='../images/1216844.png' style='width:2vw;'></a></td></tr>\n";
      }
          }else{
            echo "<p style='text-align:center;font-size:30px;'>No Users with ".strtoupper($bg)." blood found</p>";
          }
        }
        else{
          echo "<p style='text-align:center;font-size:30px;'>Enter the Correct Blood Group...</p>";
        }
        ?>
    </tbody>
    </table>
  </body>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</html>
    <?php

    mysqli_close($con);

    ?>