<?php
	session_start();
?>

<?php include 'components/header.php'; ?>
<?php include 'components/navbar.php'; ?>
<?php include 'components/leftbar.php'; ?>
<?php include 'components/container.php'; ?>

<?php
	$logsession = 0;
	
	if(!isset($_SESSION["username"]) and !isset($_GET["page"])){
		$logsession = 0;
	}
	
	if($_GET["page"] == "log"){
		$user = $_POST["user"];
		$passwort = $_POST["passwort"];
		
		if($user == "Jana" and $passwort == "goodomens"){
			$_SESSION["username"] = $user;
			$logsession = 1;
		}
		
		else{
			$logsession = 2;
		}
	}
?>

<?php
	if($logsession == 0){
?>

<h2>Login</h2>

<div id="inhalt">

	<form id="regform" method="post" action="login.php?page=log">
		<input type="text" name="user" placeholder="Username" />
		<input type="password" name="passwort" placeholder="Passwort" />
		
		<div class="button">
			<button id="regbtn" type="submit">Abschicken</button>
		</div>
	</form>
</div>

<?php
	}
	
	if($logsession == 1){
?>
	<meta http-equiv="refresh" content="4; URL=profil.php" />
	<h2>Erfolgreich eingeloggt, Sie werden weitergeleitet.</h2>
<?php
	}
?>

<?php
	if($logsession == 2){
?>

	<h2>Login fehlgeschlagen. Bitte überprüfen Sie Ihre Daten. <a href="login.php">Zurück</a></h2>

<?php
	}
?>

<?php include 'components/rightbar.php'; ?>
<?php include 'components/footer.php'; ?>