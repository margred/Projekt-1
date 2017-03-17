<?php

use HAWMS\controller\Controller;
use HAWMS\controller\ViewModel;

class LoginController extends Controller
{
    public function login()
    {
        session_start();
        $logsession = 0;

        if (!isset($_SESSION["username"]) and !isset($_GET["page"])) {
            return new ViewModel('login');
        }

        if ($_GET["page"] == "log") {
            $user = $_POST["user"];
            $passwort = $_POST["passwort"];

            if ($user == "Jana" and $passwort == "goodomens") {
                $_SESSION["username"] = $user;
                return new ViewModel('login_success');
            } else {
                return new ViewModel('login_error');
            }
        }
        return new ViewModel('login');
    }
}
