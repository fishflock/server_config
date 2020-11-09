<?php

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}

if (isset($_POST['delSourceFileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['delSourceFileName'];
    $file = "/var/www/html/hidden/uploads/" . $uid . "/".basename($fileName);
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: ../index.php');
    } else {
        echo "<h2 class='right' style='color: red'> File Delete Failed, Please Try Again> </h2>";
    }
}

if (isset($_POST['delGobsFileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['delGobsFileName'];
    $file = "/var/www/html/hidden/uploads/" . $uid . "/gobs_output/". basename($fileName);
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: /managers/gobsOutput.php');
    } else {
        echo "<h2 class='right' style='color: red'> File Delete Failed, Please Try Again> </h2>";
    }
}

if (isset($_POST['delXFileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['delXFileName'];
    $file = "/var/www/html/hidden/uploads/" . $uid . "/x_output/". basename($fileName);
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: /managers/x_output.php');
    } else {
        echo "<h2 class='right' style='color: red'> File Delete Failed, Please Try Again> </h2>";
    }
}
?>
