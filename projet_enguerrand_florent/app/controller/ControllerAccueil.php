
<!-- ----- debut ControllerAccueil -->
<?php

class ControllerAccueil {
 // --- page d'acceuil
 public static function covoiturageAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewAccueil.php';
  if (DEBUG)
   echo ("ControllerProducteur : covoiturageAccueil : vue = $vue");
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerCave -->


