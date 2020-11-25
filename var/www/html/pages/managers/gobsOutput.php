<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}

$uid = $_SESSION['uid'];

$directory = $_SERVER['DOCUMENT_ROOT'] . "/hidden/uploads/" . $uid . "/gobs_output";
if (!is_dir($directory)) {
    mkdir($directory, 0775);
}



include_once('../../phpHelpers/responses/deleteFile.php');
include_once('header.php');
include_once('../../phpHelpers/helperFunctions.php');
include_once('../../phpHelpers/responses/runFile.php');
?>
<html>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<body>
<div style="float:left; padding-left: 10%; padding-top: 2%">
<table>
    <h2>Gobs Output Files</h2>
    <hr>
    <table border='2'>
            <th>File Name</th>
            <th>File Size</th>
            <th>Date Modified</th>
            <th>Create Visualization</th>
            <th>Download File</th>
            <th>View Parameters</th>
            <th>Delete File</th>
        </tr>

        <?php
        $it = new DirectoryIterator($directory);
        foreach (new IteratorIterator($it) as $filename => $cur) {
            if ($it->isDot() || $it->isDir() || endsWith(basename($cur),"_c_mat.txt" ) || endsWith(basename($cur),"_params.txt") ) continue;
            $name = basename($cur);
            echo "<tr>";
            $sourceFileName = substr($name, 0, -4);
            echo "<td>" . $sourceFileName . "</td>";

            echo "<td>" . formatSizeUnits($cur->getSize()) . "</td>";
            echo "<td>" .  date ("Y-m-d H:i:s",filemtime($cur->getPathname()))  . "</td>";

            echo "<td><button id='btnRunFile' name='runFile' value=$name type='button'>Create Visualization </td>";

            echo "<td> <form method='post' action='/phpHelpers/responses/downloadFile.php'>";
            echo " <input name='fileNameTXT' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Download'></form>";
            echo "</td>";

            $paramFile = pathinfo($name)['filename']. '_params.txt';

            echo "<td> <form method='post' action='/phpHelpers/responses/downloadFile.php'>";
            echo " <input name='fileNameTXT' type='text' value=$paramFile hidden>";
            echo " <input name='submit' type='submit' value='Download Parameters'></form>";
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

<?php include_once('./gobsOutput_cMat.php'); ?>
<div style="float: left; padding-left: 10%">
<?php include_once('./listProcesses.php'); ?>
</div>
</body>
</html>
<!---
This is the run file popup for NetworkX Params
--->

<link rel='stylesheet' href="/pages/managers/popupStyle.css">

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method='post'>

                <label for="popupFileName">File Name</label>
                <input id='popupFileName' name='runFileNameX' type='text' value=''>

                <label for="popupNumber1">Scaling Options:</label>
                <select id='popupNumber1' name='param1' >
                    <option value="weight">Weight</option>
                    <option value="close">Close</option>
                    <option value="eigen">Eigen Value</option>
                    <option value="between">'Betweenness'</option>
                </select>

                <label for="popupNumber2">Grouping Method:</label>
                <select id='popupNumber2' name='param2' >
                    <option value="lpa">Label Propagation</option>
                    <option value="blondel">Blondel</option>
                </select>

                <label for="popupNumber3">Layout:</label>
                <select id='popupNumber3' name='param3' >
                    <option value="spring">Spring (Fruchterman-Reingold)</option>
                    <option value="fa2">Force Atlas 2</option>
                </select>

                <label for="popupNumber4">Scale Multiplier</label>
                <input id='popupNumber4' name='param4' type='number' min="0.00001" max="1" step="0.00001">

                <br><br>
                <input name='submit' type='submit' id="submit" value='Create Visualization' >

        </form>

    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

    $("button").click(function() {
        var fired_button = $(this).val();
        //update popup filename
        document.getElementById("popupFileName").setAttribute("value",fired_button);
        modal.style.display = "flex";
    });

    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];


    span.onclick = function() {
        modal.style.display = "none";
    }
    //close popup if click outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
