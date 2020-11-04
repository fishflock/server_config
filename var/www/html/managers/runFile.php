<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/debug.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: '.$_SERVER['DOCUMENT_ROOT'].'/registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}

include_once($_SERVER['DOCUMENT_ROOT'].'/processes/process.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/processes/processManagement.php');

if (isset($_POST['runFileName'])) {
    $uid = $_SESSION['uid'];
    $filePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/" . basename($_POST['runFileName']);
    $outputFilePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/gobs_output/" . pathinfo($_POST['runFileName'])['filename'].'.txt' ;

    $params= '';
    if(floatval($_POST['param1']) != 0 and floatval($_POST['param2']) != 0 and floatval($_POST['param3']) != 0) {
        $params = $_POST['param1'] . ' ' . $_POST['param2'] . ' ' . $_POST['param3'];
    }
    else{
        //default inputs
        $params = '1 1 1';
    }

    if (is_file($filePath)) {
        $newProcess = new Process("create", $_SESSION['uid'], $_POST['runFileName'], date(time()), null, "gobs", $outputFilePath, $params);
        register_process($_SESSION['uid'], $_POST['runFileName'], $newProcess->getUniqueID());
    }

}

?>
