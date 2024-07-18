<?php
include 'header.php';
$con = new mysqli("localhost","root","","majorproject",'3308');
$bg=mysqli_query($con,"SELECT * from donordetails where email='".$user['email']."'");
$bg2=mysqli_query($con,"SELECT bg from donordetails where email='".$user['email']."'");
$sql = "select email from donordetails where email='".$user['email']."'";
$result=mysqli_query($con,$sql);
  ?>
  <div class="all_users">
    <?php
if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="img" style=" border-radius:0;" >
                <?php
        $emailmp = $user['email'];
        $grav_url_120 = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailmp ) ) ) . "?d=" . urlencode( $default ) . "&s=120";
      ?>
                <img src="<?php echo $grav_url_120;?>" alt="Profile image"  style="border-radius:100%;border:1px solid black;width:150px; height:150px; margin-left:5%; float:left;">
                <a href="https://en.gravatar.com/support/activating-your-account/" style="position:absolute;top:30%;left:22%;" class="btn btn-primary">Edit Picture</a>
                
                <p style="display:inline;margin-left:2%; font-size:30px; font-weight:bold;"><?php echo $user['name']?></p>
                <br>
                <p style="display:inline;margin-left:2%; font-size:30px;">Blood Group : <?php 
          while ($row2 = mysqli_fetch_array($bg2)){
          echo "".strtoupper($row2['bg']);
          } ?></p>
          <br>
          <p style="display:inline;margin-left:2%; font-size:30px;">Email : <a href="mailto:<?php echo $user['email']?>"><?php echo $user['email']?></a></p>
            </div>
        <center>
            <hr style="width:80%;border-top:1px solid black;">
        </center>
        
        <div style="width:45%;margin-left:5%;float:left;">
        <h3>LOCATION</h3>
        <hr style="width:80%;border-top:1px solid black;">
        <?php 
        while ($row = mysqli_fetch_array($bg))
        {
          echo "<span style='font-size:22px;text-decoration:none;'>";
          echo "City<br>";
          echo "<taorem style='font-weight:bold;'>".$row['city']."</taorem>";
          echo "<br><br>Pincode / Zipcode<br>";
          echo "<taorem style='font-weight:bold;'>".$row['pin']."</taorem>";
          echo "<br><br>Address<br>";
          echo "<taorem style='font-weight:bold;'>".$row['address']."</taorem>";
          echo "</span>";
          ?>
        </div>
        <div style="width:45%;margin-left:5%; float:left;">
        <h3>Contact Information</h3>
        <hr style="width:80%;border-top:1px solid black;">
        <?php
        echo "<span style='font-size:22px;text-decoration:none;'>";
        echo "Phone Number<br>";
        echo "<taorem style='font-weight:bold;'>".$row['phn']."</taorem>";
        echo "</span>";
        ?>
        </div>
    <?php
        }}else{
          $emailmp = $user['email'];
        $grav_url_120 = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailmp ) ) ) . "?d=" . urlencode( $default ) . "&s=120";
          ?>
          <div class="img" style=" border-radius:0;" >
                <img src="<?php echo $grav_url_120;?>" alt="Profile image"  style="width:150px; height:150px; margin-left:5%; float:left;">
                <p style="display:inline;margin-left:2%; font-size:30px; font-weight:bold;"><?php echo ucwords($user['name'])?></p>
                <br>
                <p style="display:inline;margin-left:2%; font-size:30px;"><?php echo ucwords($user['name'])." has not Registered as donor."?></p>
      </div>
      <?php
        }
        ?>
        </div>
        </div>
      </div>
    </section>
  </body>
</html>
