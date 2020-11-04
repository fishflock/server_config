<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: registration/login.php');
}

$uid = $_SESSION['uid'];
if (isset($_SESSION['uid'])){
$directory = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid;
if (!is_dir($directory)) {
    mkdir($directory, 0775);
}

include_once('runFile.php');
include_once('deleteFile.php');
?>

<html>
<body>
<table>
    <h2>Uploaded Files</h2>
    <hr>
    <table border='2'>
        <tr>
            <th>File Name</th>
            <th>File Size</th>
            <th>Run through Framework</th>
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

            echo "<td>" . "<form method='post'>";
            echo " <input name='runFileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Run'></form>";

            echo "<td>" . "<form method='post'>";
            echo " <input name='delSourceFileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Delete File'></form>";

            echo "</td>";
            echo "</tr>";
        }

        }
        ?>
    </table>
</body>
</html>
