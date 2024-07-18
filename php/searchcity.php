<?php
$con = new mysqli("localhost","root","","majorproject",'3308');
$bg = $_SESSION['search'];
$searchcity = $_GET['searchcity'];
$cityresult= mysqli_query($con, "SELECT * FROM donordetails WHERE city LIKE '%{$searchcity}%' and bg LIKE '%{$bg}%'ORDER BY name ASC");
if($cityresult ==null){
  header("location:".$_SERVER['HTTP_REFERER']);
}
?>

<form action="searchcity.php" method="get" id="searchcity">
      <input type="search" name="searchcity" placeholder="Search City">
      <input type="submit" value="Search">
</form>
<?php
if ($cityresult->num_rows > 0){
?>
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
        while ($row2 = mysqli_fetch_array($cityresult))
{
  echo "<tr><td>".ucwords(strtolower($row2['name']))."</td><td><a href=".'mailto:'.$row2['email'].">".strtolower($row2['email'])."</a></td><td>".strtoupper($row2['bg'])."</td><td>".ucwords(strtolower($row2['city']))."</td><td>{$row2['address']}</td><td><a href='https://www.google.com/maps?q={$row2['lat']},{$row2['lon']}' target='_blank'><img src='../images/1216844.png' style='width:2vw;'></a></td></tr>\n";
}
}else{
  echo "<p style='text-align:center;font-size:30px;'>No Users with ".strtoupper($bg)." blood found</p>";
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