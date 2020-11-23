<?php

include_once('../../phpHelpers/processes/process.php');
include_once('../../phpHelpers/helperFunctions.php');
include_once('../../phpHelpers/responses/deleteFile.php');

if (isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    $directory = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid ."/gobs_output";

    ?>
<div style="float: left;padding-left: 10%;padding-top: 2%">
    <table>
        <h2>Gobs Co-Occurrence Matrix Output Files</h2>
        <hr>
        <table border='2'>
            <th>Source File Name</th>
            <th>File Size</th>
            <th>Date Modified</th>
            <th>Download File</th>
            <th>Delete File</th>
            </tr>

            <?php
        $it = new DirectoryIterator($directory);
        foreach (new IteratorIterator($it) as $filename => $cur) {
            if ($it->isDot() || $it->isDir() || !endsWith(basename($cur),"_c_mat.txt")) continue;
            $name = basename($cur);

            echo "<tr>";
            $sourceFileName = substr($name, 0, -10);
            echo "<td>" . $sourceFileName . "</td>";

            echo "<td>" . formatSizeUnits($cur->getSize()) . "</td>";
            echo "<td>" .  date ("Y-m-d H:i:s",filemtime($cur->getPathname()))  . "</td>";

            echo "<td> <form method='post' action='/phpHelpers/responses/downloadFile.php'>";
            echo " <input name='fileNameTXT1' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Download'></form>";
            echo "</td>";

            echo "<td>" . "<form method='post'>";
            echo " <input name='delGobsFileName' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Delete File'></form>";

            echo "</td>";
            echo "</tr>";

        }

        ?>
        </table>
</div>

<?php } ?>