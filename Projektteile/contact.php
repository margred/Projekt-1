<?php include 'components/header.php'; ?>
<?php include 'components/navbar.php'; ?>
<?php include 'components/leftbar.php'; ?>
<?php include 'components/container.php'; ?>

<?php

// Variablen für die Fehler- / Erfolgsmeldungen
$errors  = null;
$success = null;

// Sende Button wurde geklickt.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $name    = $_POST['name'];
   $email   = $_POST['email'];
   $message = $_POST['message'];

   // Name muss mindestens aus 2 Zeichen bestehen
   if (strlen($name) <= 2) {
     $errors .= 'Bitte gib deinen Namen an.<br />';
   }

   // Die E-Mail Adresse muss valide sein.
   if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $errors .= 'Bitte gebe eine gültige E-Mail Adresse an.<br />';
   }

   // Die Nachricht muss aus mindestens 8 Zeichen bestehen.
   if (strlen($message) <= 8) {
     $errors .= 'Bitte gib eine Nachricht ein.<br />';
   }

   // Wenn es keine Fehler gibt, dann E-Mail versenden.
   if ($errors == null) {
     $mailText = $name . ' ' . $email . ' ' . $message;
     mail('jana.boyens@haw-hamburg.de', 'Kontaktaufnahme', $mailText);
     $success = 'E-Mail wurde erfolgreich verschickt.';
   }
}


?>

<h2>Kontaktformular</h2>

<div id="inhalt">
  <div id="regform">
    <div style="color: green;"><?php echo $success; ?></div><br>
    <div style="color: red;"><?php echo $errors; ?></div><br>
    <form action="" method="post">
      <div>
		<input type="text" id="contactname" name="name" placeholder="Name"/>
      </div>
      <div>
        <input type="email" id="contactmailmail" name="email" placeholder="Email"/>
      </div>
      <div>
        <textarea id="contactmsg" name="message" placeholder="Nachricht"></textarea>
      </div>
      <div class="button">
        <button id="regbtn" type="submit">Abschicken</button>
      </div>
    </form>
  </div>
</div>

<?php include 'components/rightbar.php'; ?>
<?php include 'components/footer.php'; ?>