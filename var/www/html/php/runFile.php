<?php
include_once('debug.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}


if (isset($_POST['runFileName'])) {

    include_once('process.php');
    include_once('processManagement.php');


    $uid = $_SESSION['uid'];
    $filePath = "/var/www/html/hidden/uploads/" . $uid . "/" . $_POST['runFileName'];

    if (is_file($filePath)) {
        $newProcess = new Process($_SESSION['uid'], null, $_POST['runFileName'], time());
        register_process($_SESSION['uid'], $newProcess->getPid(), $_POST['runFileName']);
    }
}

?>
