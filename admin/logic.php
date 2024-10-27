<?php

    // Don't display server errors 
    ini_set("display_errors", "off");

    // Include the database connection file
    require '../app/db.conn.php';

    // Destroy if not possible to create a connection
    if(!$conn){
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }
    $date = new \DateTime();
    $date->setTimezone(new \DateTimeZone('+0530')); //GMT
    $indiandate = $date->format('Y-m-d H:i:s');
    // Get data to display on admin page
    $sql = "SELECT * FROM blog_data ORDER BY created_on DESC";
$stmt = $conn->prepare($sql);

// Execute the statement
$stmt->execute();

// Fetch all results as an associative array
$query = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // Create a new post
    if(isset($_REQUEST['new_post'])){
        $title = $_REQUEST['title'];
        $author = $_REQUEST['author'];
        $content = $_REQUEST['content'];
        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];  
        $folder = "../blog_images/".$filename;   
        $sql = "INSERT INTO blog_data(title, content,images,created_on,author) VALUES('$title', '$content','$filename','$indiandate','$author')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if (move_uploaded_file($tempname, $folder)) {

            $msg = "Image uploaded successfully";

        }else{

            $msg = "Failed to upload image";

    }
        echo $msg;
        echo $sql;
        header("Location: admin.php?info=added");
        exit();
    }

    // Get post data based on id
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
$sql = "SELECT * FROM blog_data WHERE id = :id ORDER BY created_on DESC";
$stmt = $conn->prepare($sql);

// Bind the :id parameter to the actual $id value
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the statement
$stmt->execute();

// Fetch the result
$query = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Delete a post
    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['id'];

        $sql = "DELETE FROM blog_data WHERE id = $id";
        $stmt = $conn->prepare($sql);
    $query = $stmt->execute();

        echo $msg;
        echo $sql;
            header("Location: admin.php?info=delete");
        exit();
    }

    // Update a post
    if(isset($_REQUEST['update'])){
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $author = $_REQUEST['author'];
        $content = $_REQUEST['content'];
        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];  
        $folder = "../blog_images/".$filename;   
        if(empty($filename)){
            foreach($query as $q){
            $filename=$q['images'];
            }
        }
        $sql = "UPDATE blog_data SET title = '$title', content = '$content',images = '$filename',created_on='$indiandate',author='$author' WHERE id = $id";
        $stmt = $conn->prepare($sql);
    $query = $stmt->execute();
        if (move_uploaded_file($tempname, $folder)) {

            $msg = "Image uploaded successfully";

        }else{

            $msg = "Failed to upload image";

    }
    echo $msg;
    echo $sql;
        header("Location: admin.php?info=update");
        exit();
    }

    if (isset($_REQUEST['deldoctor'])) {
	$id = $_REQUEST['deldoctor'];
    $stmt = $conn->prepare("DELETE FROM jdoctor WHERE id=$id");
    $query = $stmt->execute();
	header('location: adoctor.php?info=delete');
}
    if (isset($_REQUEST['delnurse'])) {
	$id = $_REQUEST['delnurse'];
	$stmt = $conn->prepare("DELETE FROM jnurse WHERE id=$id");
    $query = $stmt->execute();
	header('location: anurse.php?info=delete');
}
    if (isset($_REQUEST['delhtml'])) {
	$id = $_REQUEST['delhtml'];
	$stmt = $conn->prepare("DELETE FROM jhtml WHERE id=$id");
    $query = $stmt->execute();
	header('location: ahtml.php?info=delete');
}
    if (isset($_REQUEST['delcontent'])) {
	$id = $_REQUEST['delcontent'];
	$stmt = $conn->prepare("DELETE FROM jcontent WHERE id=$id");
    $query = $stmt->execute();
	header('location: acontent.php?info=delete');
}

if(isset($_REQUEST['add_camps'])){
    $sdate = $_REQUEST['sdate'];
    $edate = $_REQUEST['edate'];
    $stime = $_REQUEST['stime'];
    $etime = $_REQUEST['etime'];
    $cname = $_REQUEST['cname'];
    $cadd = $_REQUEST['cadd'];
    $state = $_REQUEST['state'];
    $district = $_REQUEST['district'];
    $contact = $_REQUEST['contact'];
    $conducted = $_REQUEST['conducted'];
    $organized = $_REQUEST['organized'];
    $sql = "INSERT INTO blood_camps(sdate,edate,stime,etime,cname,cadd,state,district,contact,conducted,organized) 
    VALUES('$sdate','$edate','$stime','$etime','$cname','$cadd','$state','$district','$contact','$conducted','$organized')";
    mysqli_query($conn, $sql);
    $msg = "Blood Camps added Successfully";
    echo $msg;
    echo $sql;
    header("Location: blood_camp.php?info=added");
    exit();
}

if (isset($_REQUEST['del_blood_camp'])) {
	$id = $_REQUEST['del_blood_camp'];
	mysqli_query($conn, "DELETE FROM blood_camps WHERE id=$id");
	echo $msg;
    echo $sql; 
	header('location: blood_camp.php?info=delete');
}


?>
