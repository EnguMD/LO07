<!-- ----- debut ControllerPassager -->
<?php

class ControllerPassager {


 // --- Liste des réservations
 public static function passagerListe() {
  $results = ModelPassager::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/passager/viewPassagerListe.php';
  if (DEBUG)
   echo ("ControllerVille : villeReadAll : vue = $vue");
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerVille -->
