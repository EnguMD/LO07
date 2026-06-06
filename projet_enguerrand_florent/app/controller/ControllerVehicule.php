
<!-- ----- debut ControllerVehicule -->
<?php
require_once '../model/ModelVehicule.php';

class ControllerVehicule {


 // --- Liste des vins
 public static function vehiculeReadAll() {
  $results = ModelVehicule::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vehicule/viewAll.php';
  if (DEBUG)
   echo ("ControllerVehicule : vehiculeReadAll : vue = $vue");
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerVehicule -->


