<?php include 'components/header.php'; ?>
<?php include 'components/navbar.php'; ?>
<?php include 'components/leftbar.php'; ?>
<?php include 'components/container.php'; ?>

<h2>Registrieren</h2>

<div id="inhalt">
	<form id="regform">
		<input type="text" placeholder="Vorname" />
		<input type="text" placeholder="Nachname" />
		<input type="text" placeholder="Studiengang" />
		<input type="int" placeholder="Semester" />
		<input type="text" placeholder="Email" />
		<input type="text" placeholder="Username" />
		<input type="password" placeholder="Passwort" />
		<input type="password" placeholder="Passwort wiederholen" />
		
		<div class="button">
			<button id="regbtn" type="submit">Abschicken</button>
		</div>
	</form>
</div>

<?php include 'components/rightbar.php'; ?>
<?php include 'components/footer.php'; ?>