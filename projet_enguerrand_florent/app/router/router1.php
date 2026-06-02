
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerVin.php');
require ('../controller/ControllerCave.php');
require ('../controller/ControllerExaminateur.php');
require ('../controller/ControllerSeConnecter.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// --- Liste des méthodes autorisées
switch ($action) {
 case "vinReadAll" :
 case "vinReadOne" :
 case "vinReadId" :
 case "vinCreate" :
 case "vinCreated" :
  ControllerVin::$action();
    break;

  


 case "superglobales" :
  ControllerExaminateur::$action();
  break;


 case "login" :
 case "deconnexion" :
  ControllerSeConnecter::$action();
  break;


 // Tache par défaut
 default:
  $action = "caveAccueil";
  ControllerCave::$action();
}
?>
<!-- ----- Fin Router1 -->

