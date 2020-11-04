<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: '.$_SERVER['DOCUMENT_ROOT'].'/registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: registration/login.php");
}

$uid = $_SESSION['uid'];

if(isset($_POST["fileName"])){
    $file =  $_POST['fileName'];

    /* Test whether the file name contains illegal characters
    such as "../" using the regular expression */
    if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
        $filepath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/x_output/" . $file;
        // Process download
        if(file_exists($filepath)) {

            header('Content-Description: File Transfer');
            header('Content-Type: image/png');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }
    } else {
        die("Invalid file name!");
    }
}
?>