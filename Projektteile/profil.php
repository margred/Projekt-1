<?php
	session_start();	
	if(isset($_SESSION["username"])){
?>

<?php include 'components/header.php'; ?>
<?php include 'components/navbar.php'; ?>
<?php include 'components/leftbar.php'; ?>
<?php include 'components/container.php'; ?>

<h2>Profil von <?php echo $_SESSION["username"]; ?></h2>

<div id="inhalt">

</div>

<?php include 'components/rightbar.php'; ?>
<?php include 'components/footer.php'; ?>

<?php
	}
	
	else{
?>

<?php include 'components/header.php'; ?>
<?php include 'components/navbar.php'; ?>
<?php include 'components/leftbar.php'; ?>
<?php include 'components/container.php'; ?>

<h2>Für diesen Bereich müssen Sie eingeloggt sein!</h2>

<?php include 'components/rightbar.php'; ?>
<?php include 'components/footer.php'; ?>

<?php
	}
?>