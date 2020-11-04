<?php
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

include_once('deleteFile.php');

?>
<html>
<body>
<table>
    <h2>Completed Visualizations</h2>
    <hr>
    <table border='2'>
        <tr>
            <th>File Name</th>
            <th>File Size</th>
            <th>Date Modified</th>
            <th>Download</th>
            <th>Delete</th>
        </tr>

        <?php
        $it = new DirectoryIterator($directory);
        foreach (new IteratorIterator($it) as $filename => $cur) {
            if ($it->isDot() || $it->isDir()) continue;
            $name = basename($cur);
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $cur->getSize() . "</td>";
            echo "<td>" . date ("Y-m-d H:i:s",filemtime($cur->getPathname())) . "</td>";

            echo "<td>" . "<form method='post' action='/managers/downloadFile.php'>";
            echo " <input name='fileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Download'></form>";
            echo "</td>";

            echo "<td>" . "<form method='post'>";
            echo " <input name='delXFileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Delete File'></form>";

            echo "</td>";
            echo "</tr>";
        }

        }
        ?>
    </table>
</body>
</html>
