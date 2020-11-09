<?php
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: registration/login.php');
}
include_once ('../phpHelpers/header.php');
?>
<head>
    <style>
        p {
            line-height: 1;
        }

    </style>
</head>
<div style="padding-left: 40%;padding-right: 25%">
    <br>
<p style="text-align: center">
    <h2> Step 1: Upload a File</h2>
    <p>Click 'Browse' to search your computer for the data you wish to upload.</p>
    <p>Note: input data must be in the form of a .csv with one value 1-4 per line</p>
    <p>Click 'Upload File' once a file has been selected.</p>
</p>
    <br>
<p>
    <h2> Step 2: Run GOBS Algorithm</h2>
    <p>The file you uploaded will appear above. Click the 'Run' button next to the selected file.</p>
    <p>Select the input parameters (0-100 for Alpha Value, 0 or 1 for Noise Reduction and Normalization, then click 'Run through GOBS Framework'.</p>

    <p>You will be taken to the next page where you can see the progress of any queued jobs, as well as any output files generated.</p>
    <p>While the algorithm is running, you can manage the process under 'Process History'.</p>
</p>
    <br>
<p>
    <h2> Step 3: Run Social Network Analysis</h2>
    <p>Once the algorithm is finished, the file will appear under 'GOBS Output File'.</p>
    <p>Click 'Run' under 'Create Visualization' to run the output through SNA.</p>
    <br>
    <h2> Step 4: Download Result</h2>
    <p>Once SNA is complete, you can download the result as a .png file.</p>
    <p>Enjoy!</p>
</p>
    <br>
    <br>
    </a>

</div>


