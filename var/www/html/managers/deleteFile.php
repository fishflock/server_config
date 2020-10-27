<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}

if (isset($_POST['delFileName'])) {
    $uid = $_SESSION['uid'];
    $fileName = $_POST['delFileName'];
    $file = "/var/www/html/hidden/uploads/" . $uid . "/$fileName";
    if (is_file($file)) {
        unlink($file); //deletes the file
        header('location: ../index.php');
    } else {
        echo "<h2 class='right' style='color: red'> File Delete Failed, Please Try Again> </h2>";
    }
}
?>
