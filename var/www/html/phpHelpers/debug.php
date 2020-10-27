<?php
function debugToConsole($msg) {
    echo "<script>console.log(".json_encode($msg).")</script>";
}
?>
