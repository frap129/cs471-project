<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Loan Dashboard</title>
		<link rel="icon" type="image/png" href="css/images/favicon.png"/>
		<link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>"/>
	</head>
	<body>
		<div>
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="#">Button2</a></li>
				<li><a href="#">Button3</a></li>
				<li style="float:right"><a class="active" href="#login.php">Login</a></li>
			</ul>
		</div>
		<div class="side-crop">
			<img src="css/images/banner.jpg" class="responsive">
		</div>
		<center>
		<br>
			<div style="width:238px">
				<form id="loginForm" method="post" name="loginForm">
					<fieldset>
						
						<legend>Login</legend>
						<p>
							<label for="uname" id="unameLabel">User Name:</label>
							<br>
							<input style="font-family: FreeMono" type="text" id="uname" name="uname">
						</p>
						<p>
							<label for="pass" id="passLabel">Password:</label>
							<br>
							<input style="font-family: FreeMono" type="password" id="pass" name="pass">
						</p>
						<br>
						<div class="rectangle centered">
							<input type="submit" name="signIn" value="Sign In" class="btn">
						</div>
					</fieldset>
				</form>
			</div>
		</center>
	</body>
</html>