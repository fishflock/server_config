<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}

include_once('../../phpHelpers/processes/process.php');
include_once('../../phpHelpers/db/processManagement.php');

$uid = $_SESSION['uid'];

$activePage = basename($_SERVER['SCRIPT_NAME']);
$tableTitle = ($activePage=='gobsOutput.php'?'GOBS Process History': 'SNA Process History');
$exe = ($activePage=='gobsOutput.php'? 'g': 'x');

if(isset($_POST['cancel'])){

    $process = new Process("check", $_SESSION['uid'], null, null, $_POST['uniqueID']);
    //check if process is in the db with correct user before allowing a stop attempt

    if(check_process($_SESSION['uid'],$_POST['uniqueID'])){
        $process->stop();
    }
}
if(isset($_POST['record'])){
    $process = new Process("check",$_SESSION['uid'],null, null, $_POST['uniqueID'], $exe);
    remove_process($_SESSION['uid'], $_POST['uniqueID']);
}

?>
<html>
<body>
<table>
    <h2><?php echo $tableTitle ?></h2>
    <hr>
    <table border='2'>
        <tr>
            <th>File Name</th>
            <th>Date Started</th>
            <th>Job Status</th>
            <th>Manage Job</th>
        </tr>

        <?php


        $result = return_process($_SESSION['uid'], $exe);
        foreach ($result as $curr) {
            $process = new Process("check",$_SESSION['uid'], $curr['file_name'],$curr['spawn_time'], $curr['uniqueID']);
            $uniqueID = $process->getUniqueID();
            echo "<tr>";
            if($exe =='g'){
                $sourceFileName = substr($curr['file_name'], 0, -4) ;
            }else if ($exe =='x'){
                $sourceFileName = substr($curr['file_name'], 0, -4);
            }

            echo "<td> " . $sourceFileName . " </td>";
            echo "<td> " . $curr['spawn_time'] . " </td>";

            if($process->status()){
                $elapsed = $process->elapsed();
                echo "<td> Running for:  $elapsed</td>";
                echo "<td>" . "<form method='post'>";
                echo " <input name='uniqueID' type='number' value='$uniqueID' hidden>";
                echo " <input name='cancel' type='submit' value='Cancel'></form>";
                echo "</td>";
            }
            else{
                echo "<td> Finished Or Stopped  </td>";
                echo "<td>" . "<form method='post'>";
                echo " <input name='uniqueID' type='number' value='$uniqueID' hidden>";
                echo " <input name='record' type='submit' value='Remove Record'></form>";
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
