<?php
session_start();
?>
<!-- ----- debut ControllerSeConnecter -->
<?php
require_once '../model/ModelSeConnecter.php';
require_once '../model/ModelUtilisateur.php';

class ControllerSeConnecter {

    public static function SeConnecterLogin() {
        include 'config.php';
        $vue = $root . '/app/view/SeConnecter/viewConnect.php';
        require ($vue);
    }

    public static function SeConnecterConnect() { //qd connecté
        $user_login = $_GET['login'];
        $user_password = $_GET['password'];
        $user = ModelSeConnecter::connected($user_login, $user_password);
        $_SESSION['login_id'] = $user->getLogin();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['solde'] = $user->getSolde();

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


