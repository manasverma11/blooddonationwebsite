<?php
include 'header.php';
      if(isset($_GET['id'])){
        $user_data = $user_obj->find_user_by_id($_GET['id']);
        if($user_data ===  false){
            header('Location: profile.php');
            exit;
        }
        else{
            if($user_data->user_id == $_SESSION['user_id']){
                header('Location: profile.php');
                exit;
            }
        }
    }

// CHECK FRIENDS
$is_already_friends = $frnd_obj->is_already_friends($_SESSION['user_id'], $user_data->user_id);
//  IF I AM THE REQUEST SENDER
$check_req_sender = $frnd_obj->am_i_the_req_sender($_SESSION['user_id'], $user_data->user_id);
// IF I AM THE REQUEST RECEIVER
$check_req_receiver = $frnd_obj->am_i_the_req_receiver($_SESSION['user_id'], $user_data->user_id);
$con = new mysqli("localhost","root","","majorproject",'3308');
$bg=mysqli_query($con,"SELECT * from donordetails where email='".$user_data->email."'");
$bg2=mysqli_query($con,"SELECT bg from donordetails where email='".$user_data->email."'");
$sql = "select email from donordetails where email='".$user_data->email."'";
$result=mysqli_query($con,$sql);
?>
    <div class="profile_container" style="margin-top:2%;">
    <?php
if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="img" style=" border-radius:0;" >
     <?php
    $emailup = $user_data->email;
      $grav_url_120 = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailup ) ) ) . "?d=" . urlencode( $default ) . "&s=120";
      ?>
                <img src="<?php echo $grav_url_120;?>" alt="Profile image"  style="border-radius:100%;border:1px solid black;width:150px; height:150px; margin-left:5%; float:left;">
                <p style="display:inline;margin-left:2%; font-size:30px; font-weight:bold;"><?php echo $user_data->name?></p>
                <br>
                <div class="inner_profile" style="float:right;margin-right:20%;">
            <div class="actions">
                <?php
                if($is_already_friends){
                    echo '<span style="border:1px solid black; padding:20px;"><taorem style="font-size:20px;font-weight:bold;"></taorem>&nbsp;<a href="functions.php?action=unfriend_req&id='.$user_data->user_id.'" class="req_actionBtn unfriend">Unfriend</a><span>';
                }
                elseif($check_req_sender){
                    echo '<span style="border:1px solid black; padding:20px;"><a href="functions.php?action=cancel_req&id='.$user_data->user_id.'" class="req_actionBtn cancleRequest">Cancel Request</a><span>';
                }
                elseif($check_req_receiver){
                    echo '<span style="border:1px solid black; padding:20px;"><taorem style="font-size:20px;font-weight:bold;">Friend Request</taorem>&nbsp;
                    <a href="functions.php?action=accept_req&id='.$user_data->user_id.'" class="req_actionBtn acceptRequest">Accept</a>
                    &nbsp;<a href="functions.php?action=ignore_req&id='.$user_data->user_id.'" class="req_actionBtn ignoreRequest">Declined</a>
                    <span>';
                }
                else{
                    echo '<span style="border:1px solid black; padding:20px;"><a href="functions.php?action=send_req&id='.$user_data->user_id.'" class="req_actionBtn sendRequest">Send Friend Request</a><span>';
                }
                ?>
        
            </div>
        </div>
                <p style="display:inline;margin-left:2%; font-size:30px;">Blood Group : <?php 
          while ($row2 = mysqli_fetch_array($bg2)){
          echo "".strtoupper($row2['bg']);
          } ?></p>
          <br>
          <p style="display:inline;margin-left:2%; font-size:30px;">Email : <a href="mailto:<?php echo $user_data->email?>"><?php echo $user_data->email?></a></p>
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

      }}else{?>
      <div class="img" style=" border-radius:0;" >
                <?php
    $emailup2 = $user_data->email;
    $grav_url_120 = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailup2 ) ) ) . "?d=" . urlencode( $default ) . "&s=120";
      ?>
                <img src="<?php echo $grav_url_120;?>" alt="Profile image"  style="width:150px; height:150px; margin-left:5%; float:left;">
                <p style="display:inline;margin-left:2%; font-size:30px; font-weight:bold;"><?php echo ucwords($user_data->name)?></p>
                <br>
                <p style="display:inline;margin-left:2%; font-size:30px;"><?php echo ucwords($user_data->name)." has not Registered as donor."?></p>
                <div class="inner_profile" style="float:right;margin-right:20%;">
            <div class="actions">
            <?php
                if($is_already_friends){
                    echo '<span style="border:1px solid black; padding:20px;"><taorem style="font-size:20px;font-weight:bold;"></taorem>&nbsp;<a href="functions.php?action=unfriend_req&id='.$user_data->user_id.'" class="req_actionBtn unfriend">Unfriend</a><span>';
                }
                elseif($check_req_sender){
                    echo '<span style="border:1px solid black; padding:20px;"><a href="functions.php?action=cancel_req&id='.$user_data->user_id.'" class="req_actionBtn cancleRequest">Cancel Request</a><span>';
                }
                elseif($check_req_receiver){
                    echo '<span style="border:1px solid black; padding:20px;"><taorem style="font-size:20px;font-weight:bold;">Friend Request</taorem>&nbsp;
                    <a href="functions.php?action=accept_req&id='.$user_data->user_id.'" class="req_actionBtn acceptRequest">Accept</a>
                    &nbsp;<a href="functions.php?action=ignore_req&id='.$user_data->user_id.'" class="req_actionBtn ignoreRequest">Declined</a>
                    <span>';
                }
                else{
                    echo '<span style="border:1px solid black; padding:20px;"><a href="functions.php?action=send_req&id='.$user_data->user_id.'" class="req_actionBtn sendRequest">Send Friend Request</a><span>';
                }
                ?>
        
            </div>
        </div>
      </div>
      
                        <?php
        }
        ?>
        </div>
    </div>
    </div>
</body>
</html>