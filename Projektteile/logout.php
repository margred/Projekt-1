<!--Nicht eingeloggt, logout-->
<?php
	session_start();	
	if(!isset($_SESSION["username"])){
?>

<?php include 'components/header.php'; ?>
<?php include 'components/navbar.php'; ?>
<?php include 'components/leftbar.php'; ?>
<?php include 'components/container.php'; ?>

<meta http-equiv="refresh" content="4; URL=login.php" />
<h2>Sie sind doch gar nicht eingeloggt! Einen Moment, bitte.</h2>

<?php include 'components/rightbar.php'; ?>
<?php include 'components/footer.php'; ?>

<?php
	}
	
	elseif(isset($_SESSION["username"])){
?>

<?php include 'components/header.php'; ?>
<?php include 'components/navbar.php'; ?>
<?php include 'components/leftbar.php'; ?>
<?php include 'components/container.php'; ?>

<meta http-equiv="refresh" content="4; URL=index.php" />
<h2>Erfolgreich ausgeloggt, Sie werden weitergeleitet.</h2>

<?php include 'components/rightbar.php'; ?>
<?php include 'components/footer.php'; ?>

<?php
	}
	
	session_destroy();	
?>