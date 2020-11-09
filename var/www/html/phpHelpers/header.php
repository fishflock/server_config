<html>
<link rel='stylesheet' href="../index.css">
<div class="header">
    <h1 class="centered">Unboxing Biological Complexity Webhost</h1>
<?php

if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    echo "<h2 class='right'>Welcome $username: <a href='/registration/index.php?logout='1'' style='color: red';>logout</a> </h2>";
}
else{
    header("location: ../registration/login.php");
}

include_once('navBar.php');
?>
</div>
</html>
