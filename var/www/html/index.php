<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: registration/login.php');
}

include_once ('phpHelpers/header.php');
?>


<div id="content" style="height:30%;width:100%;">
  <br>
    <div id="visTable" style="float:left">
        <?php include_once('managers/fileListing.php'); ?>
    </div>


    <div id="visImg" style="float: left;padding-left: 5%;padding-top: 7%">
          <form action="managers/uploadFile.php" method="post" enctype="multipart/form-data">
            Upload a New File
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload File" name="submit">
          </form>
    </div>
</div>

</html>