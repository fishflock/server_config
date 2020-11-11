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

    $validWeightParams = array("weight", "close", "eigen","between");
    $validGroupParams = array("lpa","blondel");
    $validLayoutParams = array("spring", "fa2");
    //check for valid param
    $weightParam = (in_array($_POST['param1'], $validWeightParams) ? $_POST['param1'] : "");
    $groupParam = (in_array($_POST['param2'], $validGroupParams) ? $_POST['param2'] : "");
    $layoutParam = (in_array($_POST['param3'], $validLayoutParams) ? $_POST['param3'] : "");


    $params = $weightParam . ' '. $groupParam .' '.$layoutParam ;


    if (is_file($filePath)) {
        $newProcess = new Process("create", $_SESSION['uid'], $_POST['runFileName'], date(time()), null, "x", $outputFilePath, $params);
        register_process($_SESSION['uid'], $_POST['runFileName'], $newProcess->getUniqueID());
    }
    header("location: /managers/x_output.php");
}

include_once('deleteFile.php');
include_once('../phpHelpers/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/fileSize.php');
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
            <th>Delete File</th>
        </tr>

        <?php
        $it = new DirectoryIterator($directory);
        foreach (new IteratorIterator($it) as $filename => $cur) {
            if ($it->isDot() || $it->isDir()) continue;
            $name = basename($cur);
            echo "<tr>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . formatSizeUnits($cur->getSize()) . "</td>";
            echo "<td>" .  date ("Y-m-d H:i:s",filemtime($cur->getPathname()))  . "</td>";
            echo "<td>" . "<form method='post'>";
            echo " <button id='btnRunFile' name='runFile' value=$name type='button'>Create Visualization </td>";

            echo "<td> <form method='post' action='/managers/downloadFile.php'>";
            echo " <input name='fileNameTXT' type='text' value=$name hidden>";
            echo " <input name='submit' type='submit' value='Download'></form>";
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


<?php include_once ('../processes/listProcesses.php');?>
</div>
</body>
</html>
<!---
This is the run file popup for NetworkX Params
--->

<link rel='stylesheet' href="popupStyle.css">

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method='post'>
            <label for="popupFileName">File Name</label>
            <input id='popupFileName' name='runFileName' type='text' value=''>

            <label for="popupNumber1">Scaling Options:</label>
            <select id='popupNumber1' name='param1' >
                <option value="weight">Weight</option>
                <option value="close">Close</option>
                <option value="eigen">Eigen Value</option>
                <option value="between">Weight</option>
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

