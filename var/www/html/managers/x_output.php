<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}


if (isset($_SESSION['uid'])){

$uid = $_SESSION['uid'];
$directory = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid ."/x_output";
if (!is_dir($directory)) {
    mkdir($directory, 0775);
}



include_once($_SERVER['DOCUMENT_ROOT'].'/processes/process.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/processes/processManagement.php');

include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/deleteFile.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/fileSize.php');
?>
<html>
<head>  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<style>
    img {
    float:right; margin-left:20px
    }

</style>
</head>
<div id="content" style="height:30%;width:100%;">
<div id="visTable" <div style="float:left; padding-left: 10%; padding-top: 2%">
<table>
    <h2>Completed Visualizations</h2>
    <hr>
    <table border='2'>
        <tr>
            <th>File Name</th>
            <th>File Size</th>
            <th>Date Modified</th>
            <th>View</th>
            <th>Download</th>
            <th>Delete</th>
        </tr>

        <?php
        $it = new DirectoryIterator($directory);
        foreach (new IteratorIterator($it) as $filename => $cur) {
            if ($it->isDot() || $it->isDir()) continue;
            $ogName = basename($cur);
            $name = substr(basename($cur), 0, -4 );
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . formatSizeUnits($cur->getSize()) . "</td>";
            echo "<td>" . date ("Y-m-d H:i:s",filemtime($cur->getPathname())) . "</td>";
            echo "<td> <button id='btnViewFile' name='viewFile' value=$ogName type='button'>View on Page</td>";

            echo "<td>" . "<form method='post' action='/phpHelpers/downloadFile.php'>";
            echo " <input name='fileName' type='text' value=$ogName hidden>";
            echo " <input name='submit' type='submit' value='Download'></form>";
            echo "</td>";

            echo "<td>" . "<form method='post'>";
            echo " <input name='delXFileName' type='text' value=$ogName hidden>";
            echo " <input name='submit' type='submit' value='Delete File'></form>";

            echo "</td>";
            echo "</tr>";
        }

        }
        ?>
    </table>
    </div>
    <div style="float: left;padding-top: 2%;padding-left: 5%">
    <?php
    include_once ('../processes/listProcesses.php');
    include_once('../processes/process.php');
    ?>
    </div>
    <div id="visImg" style="float: left;padding-left: 5%">
        <img id="displayImage" src="" style="width: auto; height:auto" visibility="hidden">
    </div>
</div>
</body>
</html>


<!--
On page image Loader
-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    var displayImage = document.getElementById("displayImage");

    $("button").click(function() {
        var fired_button = $(this).val();
        //update popup filename
        document.getElementById("displayImage").src = "/phpHelpers/downloadFile.php?&fileName=" +fired_button;
        document.getElementById("displayImage").visibility = "visbile";
    });

</script>
