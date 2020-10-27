<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/debug.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: '.$_SERVER['DOCUMENT_ROOT'].'/registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: registration/login.php");
}
include_once($_SERVER['DOCUMENT_ROOT'].'/processes/process.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/processes/processManagement.php');
if (isset($_POST['runFileName'])) {



    $uid = $_SESSION['uid'];
    $filePath = "/var/www/html/hidden/uploads/" . $uid . "/" . $_POST['runFileName'];

    if (is_file($filePath)) {
        $newProcess = new Process("create", $_SESSION['uid'], $_POST['runFileName'], date(time()));
        register_process($_SESSION['uid'], $_POST['runFileName'], $newProcess->getUniqueID());
    }
}

?>
