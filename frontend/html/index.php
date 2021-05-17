<?php

require_once dirname(__FILE__) . "\\..\\sources\\CommonImports.php";

use com\web\SessionUtil;

SessionUtil::commonPageLoadSessionStep(null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Dashboard</title>
    <link rel="icon" type="image/png" href="css/images/favicon.png"/>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>" type="text/css"/>
</head>
<body>
<div>
    <ul>
        <li><a class="active" href="/">Home</a></li>
        <li style="float:right"><a class="login" href="login.php">Login</a></li>
    </ul>
</div>
<div class="side-crop">
    <img src="css/images/banner.jpg" class="responsive">
</div>
<center>
    <div style="width:85%">
        <p>Welcome to [InsertName] Loan Application System!</p>
        <p>Click "Login" to get started!</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <div></div>
    </div>
</center>
</body>
</html>