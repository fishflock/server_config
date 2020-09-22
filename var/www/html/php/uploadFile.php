<?php include("auth.php");

$uploads_dir = "/var/www/html/hidden/uploads/" . $_SESSION['uid'];
$allowed = array('txt', 'csv');
$uploadOk = 1;


if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
    // basename() may prevent filesystem traversal attacks;
    // further validation/sanitation of the filename may be appropriate
    $name = basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        header('location: ../index.php');
    } else {
        echo "<h2 class='right'>File upload Failed, Please Try Again: <a href='../index.php' style='color: red';>Return</a> </h2>";
    }

}

?>