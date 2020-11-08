<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: registration/login.php');
}

include_once ('phpHelpers/header.php');
?>


  </div>
  <br>
  <?php include_once('managers/fileListing.php'); ?>
  <br>
  <form action="managers/uploadFile.php" method="post" enctype="multipart/form-data">
    Upload a New File
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
  </form>
  <?php include_once('processes/listProcesses.php'); ?>

  <?php include_once('managers/gobsOutput.php'); ?>

  <?php include_once('managers/x_output.php'); ?>

</html>