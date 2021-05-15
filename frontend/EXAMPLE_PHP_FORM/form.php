<?php
    $link = mysqli_connect('localhost','root','');
    if(mysqli_connect_error()){
        die('cannot connect');
    }
    else{
        mysqli_select_db($link,'lol_beta');
    }
    if(array_key_exists('submit', $_POST)){
        $fname1 = mysqli_real_escape_string($link,$_POST['fname1']);
        $accName1 = mysqli_real_escape_string($link,$_POST['accName1']);
        $champ = mysqli_real_escape_string($link,$_POST['champ']);
        $fname2 = mysqli_real_escape_string($link,$_POST['fname2']);
        $accName2 = mysqli_real_escape_string($link,$_POST['accName2']);
        $champ2 = mysqli_real_escape_string($link,$_POST['champ2']);
        $win = mysqli_real_escape_string($link,$_POST['win']);

        $query = "INSERT INTO match_stats(player1,ign1,champion1,player2, ign2, champion2,win)
                  VALUES                 ('$fname1','$accName1','$champ','$fname2','$accName2','$champ2','$win')";

        mysqli_query($link,$query);
        if($win == $fname1){
            $winFirst = '1';
            $winSecond = '0';
        }
        else{
            $winFirst = '0';
            $winSecond = '1';
        }

        $queryAll = "INSERT INTO all_data_dump(name, ign, champion, win) 
                     VALUES                   ('$fname1','$accName1','$champ','$winFirst'),
                                              ('$fname2','$accName2','$champ2','$winSecond') ";
        mysqli_query($link,$queryAll);

    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Fill Out Form</title>
		<link rel="icon" type="image/png" href="favicon.png"/>
		<link rel="stylesheet" href="css/styles.css" />
		<script type="text/javascript" src="tableBuild.js"></script>
	</head>
	<body style="font-family: FreeMono" onload="setSelect();">
    <div>
        <a href='/LHL/index.php'><button class="btn" type="button">See Rankings</button></a>
    </div>

		<form id="leagueForm" method="post" name="mainForm" onsubmit="setChamps();">
			<center>
				<fieldset>

					<legend>Enter Your Info</legend>
					<center>
						<p id="required">Fields marked with (*) are required.</p>
					</center>
					<p>
						<label for="fname1" id="firstLabel1">First Name *:</label><br>
						<input type="text" id="fname1" name="fname1" style="font-family: FreeMono">
					</p>
					<p>
						<label for="accName1" id="accLabel1">Summoner Name *:</label><br>
						<input type="text" id="accName1" name="accName1" style="font-family: FreeMono">
					</p>
                    <p>
                        <label for="fname2" id="firstLabel2">First Name 2 *:</label><br>
                        <input type="text" id="fname2" name="fname2" style="font-family: FreeMono">
                    </p>
                    <p>
                        <label for="accName2" id="accLabel2">Summoner Name 2 *:</label><br>
                        <input type="text" id="accName2" name="accName2" style="font-family: FreeMono">
                    </p>
					<p>
						<label for="champ" id="champLabel">Champion *:</label><br>
						<select class="templatingSelect2" name="champ" id="champ" style="font-family: FreeMono" placeholder="Select a Champion...">
						</select>
						<!---<input type="submit" value="Submit">--->
					</p>
                    <p>
                        <label for="champ2" id="champLabel">Champion *:</label><br>
                        <select class="templatingSelect2" name="champ2" id="champ2" style="font-family: FreeMono" placeholder="Select a Champion...">
                        </select>
                        <!---<input type="submit" value="Submit">--->
                    </p>
					<p>
						<label for="win" id="winLabel">Who won?(Firstname) *:</label><br>
						<input type="text" id="win" name="win" style="font-family: FreeMono">
					</p>
					<br>
					<div class="rectangle centered">
						<input type="submit" name = "submit" value="Submit" class="btn">
						<!--<script>
							
							$( "#leagueForm" ).submit(async function(event){
								event.preventDefault();
								let fileStr = await addToFile();
								//let fileStr = writeToDB;
								//Test
								console.log("About to try and write to file");
								console.log("fileStr: "+fileStr);
								$.ajax({
									async: true,
									type: 'POST',
									url: "write.php",
									data: {something: fileStr}, // key value pair created, 'something' is the key, 'foo' is the value
									success: async function(result) {
										console.log('the data was successfully sent to the server');
									}
								});
							});
						</script> -->
					</div>
				</fieldset>
			</center>
		</form> 
	</body>
</html>