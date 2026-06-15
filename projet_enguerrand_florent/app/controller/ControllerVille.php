
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
 
 // Affiche le formulaire de creation d'un vin
 public static function VilleAdd() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/ville/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau vin.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function VilleCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelVille::insert(
      htmlspecialchars($_GET['nom'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/ville/viewInserted.php';
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerVille -->


