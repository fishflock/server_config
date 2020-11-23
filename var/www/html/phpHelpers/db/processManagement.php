<?php
// connect to the database
$db = mysqli_connect('localhost', 'phpadmin', 'zxcasd123', 'registration');
function register_process($uid, $file_name, $uniqueID, $exe){
    global $db;
    $spawn_time = date('Y-m-d H:i:s',time());
    $file_name = mysqli_escape_string($db, $file_name); //could potentially cause issues,
    // may be better long term to limit filename chars

    $query = "INSERT INTO processes (uid, uniqueID, spawn_time, file_name, executable) VALUES ('$uid', '$uniqueID','$spawn_time','$file_name','$exe')";
    mysqli_query($db, $query);
}
function return_process($uid, $exe){
    global $db;
    $query = "SELECT * FROM processes WHERE uid='$uid' AND executable='$exe'";
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