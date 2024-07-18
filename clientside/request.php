<?php
include 'header.php';
?>
    <div class="profile_container">
        
        <div class="inner_profile">

        <div class="all_users">
            <h3>All Friends Requests:</h3>
            <div class="usersWrapper">
                <?php
                if($get_req_num > 0){
                    foreach($get_all_req_sender as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="../profile_images/'.$row->p_p.'" alt="Profile image"></div>
                                <div class="user_info"><span>'.$row->name.'</span>
                                <span><a href="user_profile.php?id='.$row->sender.'" class="see_profileBtn">See profile</a></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>You have no friend requests!</h4>';
                }
                ?>
            </div>
        </div>
       
    </div>
</body>
</html>
