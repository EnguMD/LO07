
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
 
 
 
 // Affiche le formulaire de creation d'un vin
 public static function VehiculeAdd() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vehicule/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau vin.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function VehiculeCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelVehicule::insert(
      htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), "conducteur", "secret", htmlspecialchars($_GET['solde'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vehicule/viewInserted.php';
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerVehicule -->