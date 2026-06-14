
<!-- ----- debut ControllerUtilisateur -->
<?php
require_once '../model/ModelTrajet.php';

class ControllerTrajet {


 // --- Liste des vins
 public static function insertTrajet() {
  $results = ModelTrajet::insertTrajet();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/trajet/viewPassagerReserve.php';
  if (DEBUG)
   echo ("ControllerVin : vinReadAll : vue = $vue");
  require ($vue);
 }
}

 ?>


