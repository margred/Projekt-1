<?php

namespace HAWMS\controller;

use HAWMS\http\Request;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $errors = null;
        $success = null;

        if ($request->isPost()) {

            $name = $request->getBody()['name'];
            $email = $request->getBody()['email'];
            $message = $request->getBody()['message'];

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
        return new ViewModel('contact', [
            'success' => $success,
            'errors' => $errors
        ]);
    }
}
