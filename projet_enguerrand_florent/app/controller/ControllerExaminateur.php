
<!-- ----- debut ControllerExaminateur -->
<?php
require_once '../model/ModelReservation.php';
class ControllerExaminateur {


 // --- Liste des superglobales
 public static function superglobales() {
  include 'config.php';
  $vue = $root . '/app/view/examinateur/viewSuperglobales.php';
  if (DEBUG)
   echo ("ControllerExaminateur : vue = $vue");
  require ($vue);
 }
 
 // Affiche un formulaire pour récupérer les informations d'un nouveau vin.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function Reservation_aleatoires() {
  // ajouter une validation des informations du formulaire
  $results = ModelReservation::insert_alea(  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/examinateur/viewInserted.php';
  require ($vue);
 }

}
?>
<!-- ----- fin ControllerExaminateur -->


