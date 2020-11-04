<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}

$uid = $_SESSION['uid'];
if (isset($_SESSION['uid'])){
$directory = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid ."/gobs_output";
if (!is_dir($directory)) {
    mkdir($directory, 0775);
}

include_once($_SERVER['DOCUMENT_ROOT'].'/processes/process.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/processes/processManagement.php');

if (isset($_POST['runFileName'])) {
    $uid = $_SESSION['uid'];
    $filePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/gobs_output/" . $_POST['runFileName'];
    $outputFilePath = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid . "/x_output/" . pathinfo($_POST['runFileName'])['filename'].'.png'  ;

    if (is_file($filePath)) {
        $newProcess = new Process("create", $_SESSION['uid'], $_POST['runFileName'], date(time()), null, "x", $outputFilePath);
        register_process($_SESSION['uid'], $_POST['runFileName'], $newProcess->getUniqueID());
    }
}

include_once('deleteFile.php');
?>
<html>
<body>
<table>
    <h2>Gobs Output Files</h2>
    <hr>
    <table border='2'>
            <th>File Name</th>
            <th>File Size</th>
            <th>Date Modified</th>
            <th>Create Visualization</th>
            <th>Delete File</th>
        </tr>

        <?php
        $it = new DirectoryIterator($directory);
        foreach (new IteratorIterator($it) as $filename => $cur) {
            if ($it->isDot() || $it->isDir()) continue;
            $name = basename($cur);
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $cur->getSize() . "</td>";
            echo "<td>" .  date ("Y-m-d H:i:s",filemtime($cur->getPathname()))  . "</td>";
            echo "<td>" . "<form method='post'>";
            echo " <input name='runFileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Run'></form>";

            echo "</td>";

            echo "<td>" . "<form method='post'>";
            echo " <input name='delGobsFileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Delete File'></form>";

            echo "</td>";
            echo "</tr>";
        }

        }
        ?>
    </table>
</body>
</html>
