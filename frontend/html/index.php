<?php

require_once dirname(__FILE__) . "/../sources/CommonImports.php";

use com\web\SessionUtil;

SessionUtil::commonPageLoadSessionStep(null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$Post-Ya-Loan - Home</title>
    <link rel="icon" type="image/png" href="css/images/favicon.png?v=<?php echo time(); ?>"/>
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
	<div class="titleCentered">$Post-Ya-Loan</div>
</div>
<center>
    <div style="width:85%">
        <p>Welcome to $Post-Ya-Loan the Loan Application System!</p>
        <p id="ranNum"></p>
		<p>Click "Login" to get started!</p>
        <script>
			document.getElementById("ranNum").innerHTML = "Apply for a loan from one of our 2 partnered banks! We approve ";
			document.getElementById("ranNum").innerHTML += Math.round((Math.random())*100);
			document.getElementById("ranNum").innerHTML += "% of loans!!"
		</script>
		<div></div>
    </div>
</center>
</body>
</html>