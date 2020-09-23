<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: registration/login.php');
}

$uid = $_SESSION['uid'];
if (isset($_SESSION['uid'])){
$directory = "/var/www/html/hidden/uploads/" . $uid;
    if (!is_dir($directory)) {
        mkdir($directory, 0775);
    }
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
        $it = new RecursiveDirectoryIterator($directory);
        foreach (new RecursiveIteratorIterator($it) as $filename => $cur) {
            if ($it->isDot()) continue;
            $name = basename($cur);
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $cur->getSize() . "</td>";
            echo "<td>" . "<a href='php/runFile.php?fileName=$name' style='color: darkblue;'>Run </a>" . "</td>";
            //echo "<td>" . "<a href='php/deleteFile.php?fileName=$name' style='color: red;'>Delete</a>" . "</td>";
            echo "<td>" . "<form method='post' action='php/deleteFile.php'>";
            echo " <input name='fileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Delete File'></form>";

            echo "</td>";
            echo "</tr>";
        }

        }
        ?>
    </table>
</body>
</html>
