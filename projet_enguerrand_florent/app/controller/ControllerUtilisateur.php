
<!-- ----- debut ControllerUtilisateur -->
<?php
require_once '../model/ModelUtilisateur.php';

class ControllerUtilisateur {


 // --- Liste des vins
 public static function utilisateurReadAll() {
  $results = ModelUtilisateur::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/utilisateur/viewAll.php';
  if (DEBUG)
   echo ("ControllerVin : vinReadAll : vue = $vue");
  require ($vue);
 }

}
?>
<!-- ----- fin ControllerUtilisateur -->


