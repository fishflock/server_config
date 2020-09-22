<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: registration/login.php');
}
?>

<html>
  <link rel='stylesheet' href="index.css">
  <div class="header">
    <h1 class="centered">Geometry of Behavioural Spaces Webhost</h1>
      <?php

      if (isset($_SESSION['username'])){
          $username = $_SESSION['username'];
          echo "<h2 class='right'>Welcome $username: <a href='registration/index.php?logout='1'' style='color: red';>logout</a> </h2>";
      }
      else{
          echo "<h2 class='right''><a href='login.html''>Login </a></h2>";
      }
      ?>

  </div>
  <hr />
  <br>
  <br>
  <?php include('php/fileListing.php'); ?>
  <br>
  <form action="php/uploadFile.php" method="post" enctype="multipart/form-data">
    Upload a New File
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
  </form> 
  

</html>