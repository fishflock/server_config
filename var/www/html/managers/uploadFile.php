<?
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: '.$_SERVER['DOCUMENT_ROOT'].'/registration/login.php');
}

$uploads_dir = "/var/www/html/hidden/uploads/" . $_SESSION['uid'];
$allowed = array('txt', 'csv');
$uploadOk = 1;


if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];
    $name = basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
        header('location: '.$_SERVER['DOCUMENT_ROOT'].'/index.php');
    } else {
        echo "<h2 class='right'>".$_SERVER['DOCUMENT_ROOT']."</h2>";
        echo "<h2 class='right'>File upload Failed, Please Try Again: <a href=".$_SERVER['DOCUMENT_ROOT']. "/index.php style='color: #ff0000';>Return</a> </h2>";
    }

}

?>