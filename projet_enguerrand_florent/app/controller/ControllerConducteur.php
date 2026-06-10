<!-- ----- debut ControllerConducteur -->
<?php

class ControllerConducteur {


 // --- Liste des réservations
 public static function conducteurListe() {
  $results = ModelUtilisateur::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/passager/viewConducteurListe.php';
  if (DEBUG)
   echo ("ControllerConducteur : conducteurReadAll : vue = $vue");
  require ($vue);
 }
 
 
 
 // Affiche le formulaire de creation d'un vin
 public static function utilisateurAddConducteur() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/conducteur/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau vin.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function ConducteurCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelUtilisateur::insert(
      htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), "conducteur", "secret", htmlspecialchars($_GET['solde'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/conducteur/viewInserted.php';
  require ($vue);
 }
 
 
}
?>
<!-- ----- fin ControllerConducteur -->
