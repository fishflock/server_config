<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../../registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: ../../registration/login.php");
}

$uid = $_SESSION['uid'];

//used on the x_output.php page when the download button is pressed
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

//used to load images onto the x_Output.php page when the 'view On Page' button is pressed
if(isset($_GET["fileName"])){
    $file =  $_GET['fileName'];
    /* Test whether the file name contains illegal characters
    such as "../" using the regular expression */
    if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
        $filepath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/x_output/" . $file;
        // Process retrieval
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

//used by the gobsOutput.php and gobsOutput_cMat_i.php files to allow users to download files that are generated in the $uid/gobs_output/ folder
if(isset($_POST["fileNameTXT"]) || isset($_POST["fileNameTXT1"])){
    $file =  (isset($_POST["fileNameTXT"]) ? $_POST['fileNameTXT']: $_POST['fileNameTXT1']);

    /* Test whether the file name contains illegal characters
    such as "../" using the regular expression */
    if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
        $filepath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/gobs_output/" . $file;
        // Process download
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: txt/plain');
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


//used by x_output to download parameters files
if(isset($_POST["fileNameTXTX"]) ){
    $file =  $_POST["fileNameTXTX"];

    /* Test whether the file name contains illegal characters
    such as "../" using the regular expression */
    if(preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)){
        $filepath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/x_output/" . $file;
        // Process download
        if(file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: txt/plain');
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