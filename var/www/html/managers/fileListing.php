<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}

$uid = $_SESSION['uid'];
if (isset($_SESSION['uid'])){
$directory = $_SERVER['DOCUMENT_ROOT']."/hidden/uploads/" . $uid;
if (!is_dir($directory)) {
    mkdir($directory, 0775);
}

include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/runFile.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/deleteFile.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpHelpers/fileSize.php');
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
            echo "<td>" . formatSizeUnits($cur->getSize()) . "</td>";

            echo "<td> <button id='btnRunFile' name='runFile' value=$name type='button'>Run GOBS on this File</td>";

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
<!---
This is the run file popup.  It uses a div that is shown/hidden with javascript (below)
It is hidden by default in css
--->

<link rel='stylesheet' href="../managers/popupStyle.css">

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method='post'>
            <label for="popupFileName">File Name:</label>
            <input id='popupFileName' name='runFileName' type='text' value=''>

            <label for="popupNumber1">Normalization:</label>
            <input id='popupNumber1' name='param1' type='number' min="0" max="1" >

            <label for="popupNumber2">Alpha Value:</label>
            <input id='popupNumber2' name='param2' type='number' min="0.00001" max="100" step="0.00001">

            <label for="popupNumber3">Vectory History Length:</label>
            <input id='popupNumber3' name='param3' type='number' min="5" max="15">

            <label for="popupNumber4">Number of Directions:</label>
            <select id='popupNumber4' name='param4' >
                <option value="4">4</option>
                <option value="8">8</option>
            </select>

            <label for="popupNumber5">Statistical Comparison Method:</label>
            <select id='popupNumber5' name='param5' >
                <option value="1">Chi Squared</option>
                <option value="2">G-Test</option>
            </select>

            <br><br>
            <input name='submit' type='submit' id="submit" value='Run Through GOBS' >

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

