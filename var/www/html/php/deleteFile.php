<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../registration/login.php');
}

if (isset($_POST['fileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['fileName'];
    $file = "/var/www/html/hidden/uploads/" . $uid . "/$fileName";
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: ../index.php');
    } else {
        echo "<h2 class='right'>File Delete Failed, Please Try Again: <a href='../index.php' style='color: red';>Return</a> </h2>";
    }
}
?>
