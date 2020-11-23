<?php

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}

//each of these different post values corresponds to a different directory that will be deleted from
//uploaded directory
if (isset($_POST['delSourceFileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['delSourceFileName'];
    $file = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/".basename($fileName);
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: /index.php');
    } else {
        echo "<h2 class='right' style='color: red'> File Delete Failed, Please Try Again> </h2>";
    }
}
//gobs output
if (isset($_POST['delGobsFileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['delGobsFileName'];
    $file = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/gobs_output/". basename($fileName);
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: /pages/managers/gobsOutput.php');
    } else {
        echo "<h2 class='right' style='color: red'> File Delete Failed, Please Try Again> </h2>";
    }
}
//nX output
if (isset($_POST['delXFileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['delXFileName'];
    $file = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/x_output/". basename($fileName);
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: /pages/managers/x_output.php');
    } else {
        echo "<h2 class='right' style='color: red'> File Delete Failed, Please Try Again> </h2>";
    }
}
?>
