<?php
session_start();
?>
<!-- ----- debut ControllerSeConnecter -->
<?php
require_once '../model/ModelSeConnecter.php';

class ControllerSeConnecter {

    public static function SeConnecterLogin() {
        include 'config.php';
        $vue = $root . '/app/view/SeConnecter/viewConnect.php';
        require ($vue);
    }

    public static function SeConnecterConnect() {
        $user_login = $_GET['login'];
        $user_password = $_GET['password'];
        $_SESSION['login_id'] = ModelSeConnecter::connected($user_login, $user_password);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        require ($vue);
    }

    // --- Liste des producteur
    public static function SeConnecterDeconnexion() {
        $_SESSION['login_id'] = -1;
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        if (DEBUG)
            echo ("ControllerSeConnecter : vue = $vue");
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerSeConnecter -->


