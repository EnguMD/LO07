
<!-- ----- debut ControllerVille -->
<?php
require_once '../model/ModelVille.php';

class ControllerVille {


 // --- Liste des vins
 public static function villeReadAll() {
  $results = ModelVille::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/ville/viewAll.php';
  if (DEBUG)
   echo ("ControllerVille : villeReadAll : vue = $vue");
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerVille -->


