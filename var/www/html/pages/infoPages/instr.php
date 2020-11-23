<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: /registration/login.php');
}
include_once('../managers/header.php');
?>
<head>
    <style>
        p {
            line-height: 1.2;
        }

    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<div style="padding-left: 40%;padding-right: 25%">
    <br>
<p style="text-align: center">
    <h2> Step 1: Upload a File</h2>
    <p>Click 'Browse' to search your computer for the data you wish to upload.</p>
    <p>Input Data Format:</p>
    <ol>
        <li>Must be a csv file</li>
        <li>Should have numbers, comma separated, with each line representing a specific agent</li>
        <li>The numbers should represent the direction that the agent took in that time step</li>
        <li>The range of these numbers will match the 'Number of Directions' Parameter that is inputted into GOBS</li>
    </ol>
    <br>
    <p>Click 'Upload File' once a file has been selected.</p>
</p>
    <br>
<p>
    <h2> Step 2: Run GOBS Algorithm</h2>
    <p>The file you uploaded will appear above. Click the 'Run' button next to the selected file.</p>
    <p>Select the input parameters: </p>
    <ol>
        <li>0 or 1 for Normalization </li>
        <li>0-100 for Alpha Value (with .00001 increments) </li> <br>
        <li>5-15 for Vector History Length </li> <br>
        <li>2-10 for Number of Directions</li> <br>
        <li>Then choose from the available Statistical Comparison Methods</li> <br>
    </ol>
    <br>
    <p>Then click 'Run through GOBS Framework'.</p>

    <p>You will be taken to the next page where you can see the progress of any queued jobs, as well as any output files generated.</p>
    <p>While the algorithm is running, you can manage the process under 'Process History'.</p>
</p>
    <br>
<p>
    <h2> Step 3: Run Social Network Analysis</h2>
    <p>Once the algorithm is finished, the file will appear under 'GOBS Output File'.</p>
    <p>Click 'Create Visualization' to run the output through SNA.</p>
    <p>Select the input parameters that you desire:
        <br>The scale multiplier will make your resulting graph larger or smaller
    <br>
    <h2> Step 4: Download the Result</h2>
    <p>Once SNA is complete, you can download the result as a .png file or view it on the page.</p>
    <p>Enjoy!</p>
</p>
    <br>
    <br>
    </a>

</div>


