<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: registration/login.php');
}

$uploads_dir = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $_SESSION['uid'];
$allowed = array('txt', 'csv');
$uploadOk = 1;

if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];

    $name = basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        header('location: ../index.php');
    } else {
        echo "<h2 class='right'>File upload Failed, Please Try Again: <a href='../index.php' style='color: red'>Return</a> </h2>";
    }

}

?>