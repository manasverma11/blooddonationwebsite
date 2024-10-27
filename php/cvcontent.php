<?php
if (($_FILES['file']['name']!="")){
    // Where the file is going to be stored
        $target_dir = "../cv/";
        $file = $_FILES['file']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['file']['tmp_name'];
        $path_filename_ext = $target_dir.$filename.".".$ext;
}
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $tel = $_POST['tel'];    
    $exp = $_POST['exp'];
    $qua = $_POST['qua'];
    $tel = $_POST['tel'];
    $file = $filename.".".$ext;

    // Include the database connection file
    require_once '../app/db.conn.php';

if (mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_error().')');
}
else{
    $sql = "INSERT INTO jcontent (fullname,email,address,city,zip,exp,qua,tel,cv)
    values('$fullname','$email','$address','$city','$zip','$exp','$qua','$tel','$file')";
    if ($conn->query($sql)){
        move_uploaded_file($temp_name,$path_filename_ext);
            include 'header.php';
            include '../php/fileuploaded.php';
            
      exit();
    }
    else{
        include 'header.php';
            include '../php/filenotuploaded.php';
    }
    
    $conn->close();
}

?>