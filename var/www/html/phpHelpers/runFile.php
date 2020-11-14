<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/phpHelpers/debug.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: '.$_SERVER['DOCUMENT_ROOT'].'/registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/processes/process.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/processes/processManagement.php');

if (isset($_POST['runFileName'])) {
    $uid = $_SESSION['uid'];
    $filePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/" . basename($_POST['runFileName']);
    $outputFilePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/gobs_output/" . pathinfo($_POST['runFileName'])['filename'].'.txt' ;

    $params = floatval($_POST['param1']) . ' ' . floatval($_POST['param2']) . ' ' . floatval($_POST['param3']) . ' ' . floatval($_POST['param4']) . ' ' . floatval($_POST['param5']);

    if (is_file($filePath)) {
        $newProcess = new Process("create", $_SESSION['uid'], $_POST['runFileName'], date(time()), null, "gobs", $outputFilePath, $params);
        register_process($_SESSION['uid'], $_POST['runFileName'], $newProcess->getUniqueID(), 'g');
    }
    header("location: /managers/gobsOutput.php");

}

?>
