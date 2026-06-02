
<!-- ----- debut ControllerCave -->
<?php
require_once '../model/ModelVin.php';

class ControllerCave {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewAccueil.php';
  if (DEBUG)
   echo ("ControllerProducteur : caveAccueil : vue = $vue");
  require ($vue);
 }

}
?>
<!-- ----- fin ControllerCave -->


