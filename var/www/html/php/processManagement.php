<?php
// connect to the database
$db = mysqli_connect('localhost', 'phpadmin', 'zxcasd123', 'registration');
include_once ('debug.php');
function register_process($uid, $file_name, $uniqueID){
    global $db;
    $spawn_time = date('Y-m-d H:i:s',time());
    $query = "INSERT INTO processes (uid, uniqueID, spawn_time, file_name) VALUES ('$uid', '$uniqueID','$spawn_time','$file_name')";
    mysqli_query($db, $query);
}
function return_process($uid){
    global $db;
    $query = "SELECT * FROM processes WHERE uid='$uid'";
    return mysqli_query($db, $query);
}

function remove_process($uid, $uniqueID){
    global $db;
    $query = "delete from processes WHERE uid='$uid' and uniqueID='$uniqueID'";
    mysqli_query($db, $query);
}

function check_process($uid, $uniqueID){
    global $db;
    $query = "SELECT uid, uniqueID FROM processes WHERE uid='$uid' and uniqueID='$uniqueID'";
    $result = mysqli_query($db, $query);
    foreach ($result as $curr){
        if($curr['uid'] == $uid and $curr['uniqueID'] ==$uniqueID){
            return true;
        }
    }
    return false;

}
?>