<?php
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
if (!isset($_SESSION['uid'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
?>

<html>
<link rel='stylesheet' href="/index.css">
<div class="header">
    <h1 class="centered">Unboxing Biological Complexity Webhost</h1>
<?php
//A default header for all of the user visible pages, including a navbar

$username = $_SESSION['username'];
//includes style for the header
echo "<h2 class='right'>Welcome $username: <a href='/registration/index.php?logout='1'' style='color: red';><u>logout</u></a> </h2>";

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
        <li <?php if($active_page =='index.php'){echo "class='selected'";} ?> ><a href="/index.php">1.Data Files/Run GOBS</a></li>
        <li <?php if($active_page =='gobsOutput.php'){echo "class='selected'";} ?>><a href="/pages/managers/gobsOutput.php">2.GOBS Algorithm Output</a></li>
        <li <?php if($active_page =='x_output.php'){echo "class='selected'";} ?>><a href="/pages/managers/x_output.php">3.Social Network Analysis Output</a></li>
        <li <?php if($active_page =='instr.php'){echo "class='selected'";} ?>><a href="/pages/infoPages/instr.php">Instructions</a></li>
        <li <?php if($active_page =='about.php'){echo "class='selected'";} ?>><a href="/pages/infoPages/about.php">About This Project</a></li>
    </ul>




</div>
</html>
