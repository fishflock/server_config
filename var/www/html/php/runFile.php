<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}
if (!isset($_GET['filename'])) {
    header("location: /registration/login.php");
}

$uid = $_SESSION['uid'];

$output_directory = "/var/www/html/hidden/uploads/" . $uid . "/output";
$output_file = "/var/www/html/hidden/uploads/" . $uid . "/output/" .  $_GET['filename'] .":". date(time());

$progress_directory = "/var/www/html/hidden/uploads/" . $uid . "/progress";
$progress_file = "/var/www/html/hidden/uploads/" . $uid . "/progress/" .  $_GET['filename'] .":". date(time());

$file_path = "/var/www/html/hidden/uploads/" . $uid . "/". $_GET['filename'];

if (!is_dir($output_directory)) {
    mkdir($output_directory, 0775);
}
if (!is_dir($progress_directory)) {
    mkdir($progress_directory, 0775);
}

if(is_file($file_path)){

    touch($output_file);
    touch($progress_file);

    $commands = "/var/www/html/GOBS/gobs"; //path to GOBS binary

    $descriptors = array(
        0 => array("pipe", "r"), //read stdin from a pipe
        1 => array("file", $progress_file, "a"), //output stdout and err to a file
        2 => array("file", $progress_file, "a")
    );

    $process = proc_open($commands, $descriptors, $pipes);

    if(is_resource($process)){
        echo "Test";

    }
}

?>
