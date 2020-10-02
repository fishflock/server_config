<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    header("location: /registration/login.php");
}

include_once('process.php');
include_once('processManagement.php');

$uid = $_SESSION['uid'];

if(isset($_POST['cancel'])){ //needs some sort of security check if pid is duplicated

    $process = new Process("check", $_SESSION['uid'], null, null, $_POST['uniqueID']);
    //check if process is in the db with correct user before allowing it to stop

    if(check_process($_SESSION['uid'],$_POST['uniqueID'])){
        $process->stop();
    }
}
if(isset($_POST['record'])){
    $process = new Process("check",$_SESSION['uid'],null, null, $_POST['uniqueID']);
    remove_process($_SESSION['uid'], $_POST['uniqueID']);
}

?>
<html>
<body>
<table>
    <h2>Process History</h2>
    <hr>
    <table border='2'>
        <tr>
            <th>File Name</th>
            <th>Date Started</th>
            <th>Job Status</th>
            <th>Manage Job</th>
        </tr>

        <?php
        $result = return_process($_SESSION['uid']);
        foreach ($result as $curr) {
            $process = new Process("check",$_SESSION['uid'], $curr['file_name'],$curr['spawn_time'], $curr['uniqueID']);
            $uniqueID = $process->getUniqueID();
            echo "<tr>";
            echo "<td>" . $curr['file_name'] . "</td>";
            echo "<td>" . $curr['spawn_time'] . "</td>";
            echo "<td>" . $process->status() . "</td>";
            if($process->status()){
                echo "<td>" . "<form method='post'>";
                echo " <input name='uniqueID' type='number' value='$uniqueID' hidden>";
                echo " <input name='cancel' type='submit' value='Cancel'></form>";
                echo "</td>";
            }
            else{
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
