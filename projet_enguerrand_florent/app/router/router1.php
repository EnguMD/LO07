
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerUtilisateur.php');
require ('../controller/ControllerConducteur.php');
require ('../controller/ControllerPassager.php');
require ('../controller/ControllerVehicule.php');
require ('../controller/ControllerVille.php');
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
    case "utilisateurReadAll" :
        ControllerUtilisateur::$action();
        break;

    case "vehiculeReadAll" :
    case "VehiculeAdd" :
    case "VehiculeCreated" :
        ControllerVehicule::$action();
        break;

    case "villeReadAll" :
        ControllerVille::$action();
        break;

    case "superglobales" :
        ControllerExaminateur::$action();
        break;

    // Tache par défaut
    case "passagerListe" :
    case "passagerReservation" :
    case "passagerInnovation" :
    case "utilisateurAddPassager" :
    case "PassagerCreated" :
        ControllerPassager::$action();
        break;

    case "utilisateurAddConducteur" :
    case "ConducteurCreated" :
        ControllerConducteur::$action();
        break;

    case "SeConnecterLogin" :
    case "SeConnecterConnect" :
    case "SeConnecterDeconnexion" :
        ControllerSeConnecter::$action();
        break;

    // Tache par défaut
    default:
        $action = "caveAccueil";
        ControllerCave::$action();
}
?>
<!-- ----- Fin Router1 -->

