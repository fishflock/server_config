<?php
// connect to the database
$db = mysqli_connect('localhost', 'phpadmin', 'zxcasd123', 'registration');
include_once ('debug.php');
function register_process($uid, $pid, $file_name){
    global $db;
    $spawn_time = date('Y-m-d H:i:s',time());
    $query = "INSERT INTO processes (uid, pid, spawn_time, file_name) VALUES ('$uid','$pid','$spawn_time','$file_name')";
    mysqli_query($db, $query);
    debugToConsole($db->error);
}
function return_process($uid){
    global $db;
    $query = "SELECT * FROM processes WHERE uid='$uid'";
    debugToConsole($db->error);
    return mysqli_query($db, $query);
}

function remove_process($uid, $pid){
    global $db;
    $query = "delete from processes WHERE uid='$uid' and pid='$pid'";
    mysqli_query($db, $query);
    debugToConsole($db->error);
}
?>