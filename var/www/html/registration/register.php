<?php include_once('../phpHelpers/db/loginManagement.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register for GOBS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Register</h2>
</div>

<form method="post" action="register.php">
    <?php include_once('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already have an account? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>