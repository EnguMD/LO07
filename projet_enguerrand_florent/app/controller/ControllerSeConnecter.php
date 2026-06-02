
<!-- ----- debut ControllerSeConnecter -->
<?php
require_once '../model/ModelProducteur.php';

class ControllerSeConnecter {
 // --- page d'acceuil
 public static function login() {
  include 'config.php';
  $vue = $root . '/app/view/SeConnecter/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerSeConnecter : vue = $vue");
  require ($vue);
 }

 // --- Liste des producteur
 public static function deconnexion() {
$_SESSION['login_id'] = -1;
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerSeConnecter : vue = $vue");
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerSeConnecter -->


