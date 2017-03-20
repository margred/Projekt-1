<?php

namespace HAWMS\controller;

use HAWMS\auth\BadCredentialsException;
use HAWMS\auth\EmailPasswordAuthentication;
use HAWMS\auth\EmailPasswordAuthenticationProvider;

class LoginController extends Controller
{
    private $emailPasswordAuthenticationProvider;

    /**
     * LoginController constructor.
     * @param EmailPasswordAuthenticationProvider $emailPasswordAuthenticationProvider
     */
    public function __construct(EmailPasswordAuthenticationProvider $emailPasswordAuthenticationProvider)
    {
        $this->emailPasswordAuthenticationProvider = $emailPasswordAuthenticationProvider;
    }

    public function login()
    {
        $logsession = 0;

        if (!isset($_SESSION["username"]) and !isset($_GET["page"])) {
            return new ViewModel('login');
        }

        if ($_GET["page"] == "log") {
            $user = $_POST["user"];
            $passwort = $_POST["passwort"];
            $authentication = new EmailPasswordAuthentication($user, $passwort);
            try {
                $user = $this->emailPasswordAuthenticationProvider->authenticate($authentication);
                $_SESSION['user'] = $user;
                return new ViewModel('login_success');
            } catch (BadCredentialsException $e) {
                return new ViewModel('login_error');
            }
        }
        return new ViewModel('login');
    }
}
