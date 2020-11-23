<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}

include_once('./pages/managers/header.php');
?>

<div id="content" style="height:30%;width:100%;">
  <br>
    <div id="visTable" style="float:left; padding-left: 8%; padding-top: 2%">
        <?php include_once('./pages/managers/fileListing.php'); ?>
        <p>You may need to refresh the page if newly uploaded files are not in the list.</p>
    </div>


    <div id="visImg" style="float: left;">
        <?php include_once('./phpHelpers/responses/fileUpload.php'); ?>
    </div>
</div>

</html>