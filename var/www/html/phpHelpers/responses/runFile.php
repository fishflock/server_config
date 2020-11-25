<?php
//Used to spawn GOBS  processes from fileListing.php
//and networkX (python) from gobsOutput.php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/phpHelpers/processes/process.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/phpHelpers/db/processManagement.php');

//spawn gobs processes
if (isset($_POST['runFileName'])) {
    $uid = $_SESSION['uid'];
    $filePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/" . basename($_POST['runFileName']);
    $outputFilePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/gobs_output/" . pathinfo($_POST['runFileName'])['filename'].'.txt' ;
    $cmdFilePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/gobs_output/" . pathinfo($_POST['runFileName'])['filename'].'_params.txt';
    $params = floatval($_POST['param1']) . ' ' . floatval($_POST['param2']) . ' ' . floatval($_POST['param3']) . ' ' . floatval($_POST['param4']) . ' ' . floatval($_POST['param5']);

    if (is_file($filePath)) {
        $newProcess = new Process("create", $_SESSION['uid'], $_POST['runFileName'], date(time()), null, "gobs", $outputFilePath, $params);
        register_process($_SESSION['uid'], $_POST['runFileName'], $newProcess->getUniqueID(), 'g');

        $cmdFile = fopen($cmdFilePath, "w");
        fwrite($cmdFile, $newProcess->getRunParams());
        header("location: /pages/managers/gobsOutput.php");
    }


}


//spawn networkX processes
if (isset($_POST['runFileNameX'])) {
    $uid = $_SESSION['uid'];
    $filePath = $_SERVER['DOCUMENT_ROOT'] . "/hidden/uploads/" . $uid . "/gobs_output/" . basename($_POST['runFileNameX']);
    $outputFilePath = $_SERVER['DOCUMENT_ROOT'] . "/hidden/uploads/" . $uid . "/x_output/" . pathinfo($_POST['runFileNameX'])['filename'] . '.png';
    $cmdFilePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/x_output/" . pathinfo($_POST['runFileNameX'])['filename'].'_params.txt';

    $validWeightParams = array("weight", "close", "eigen", "between");
    $validGroupParams = array("lpa", "blondel");
    $validLayoutParams = array("spring", "fa2");

    //check for valid param
    $weightParam = (in_array($_POST['param1'], $validWeightParams) ? $_POST['param1'] : "");
    $groupParam = (in_array($_POST['param2'], $validGroupParams) ? $_POST['param2'] : "");
    $layoutParam = (in_array($_POST['param3'], $validLayoutParams) ? $_POST['param3'] : "");

    $params = $weightParam . ' ' . $groupParam . ' ' . $layoutParam . ' ' . floatval($_POST['param4']);

    if (is_file($filePath)) {
        $newProcess = new Process("create", $_SESSION['uid'], $_POST['runFileNameX'], date(time()), null, "x", $outputFilePath, $params);
        register_process($_SESSION['uid'], $_POST['runFileNameX'], $newProcess->getUniqueID(), 'x');

        $cmdFile = fopen($cmdFilePath, "w");
        fwrite($cmdFile, $newProcess->getRunParams());

        header("location: /pages/managers/x_output.php");
    }

}




?>
