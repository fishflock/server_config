<?php
$active_page = basename($_SERVER['SCRIPT_NAME']);

?>

<html>

<head>
<style>
    ul {list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333333;}

    li {float: left;}

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #f50000;
    }
    li.selected a{
        color: #d72722;
    }

</style>
</head>
<ul >
    <li <?php if($active_page =='index.php'){echo "class='selected'";} ?> ><a href="/index.php">1.Data Files</a></li>
    <li <?php if($active_page =='gobsOutput.php'){echo "class='selected'";} ?>><a href="/managers/gobsOutput.php">2.GOBS Algorithm</a></li>
    <li <?php if($active_page =='x_output.php'){echo "class='selected'";} ?>><a href="/managers/x_output.php">3.Social Network Analysis</a></li>
    <li <?php if($active_page =='instr.php'){echo "class='selected'";} ?>><a href="/infoPages/instr.php">Instructions</a></li>
    <li <?php if($active_page =='about.php'){echo "class='selected'";} ?>><a href="/infoPages/about.php">About US</a></li>
</ul>


</html>





