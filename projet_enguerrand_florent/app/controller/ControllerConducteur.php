<!-- ----- debut ControllerConducteur -->
<?php

class ControllerConducteur {

    public static function conducteurTrajetAjout() {
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewConducteurTrajetAjout.php';

        if (DEBUG)
            echo ("ControllerConducteur : conducteurTrajetAjout : vue = $vue");

        require ($vue);
    }
    
    public static function conducteurTrajetAjoute() {
        $database = Model::getInstance();
        
        //id du cond
        $query = "SELECT id FROM utilisateur WHERE login = :login";
        $statement = $database->prepare($query);
        $statement->execute(['login' => $_SESSION['login_id']]);
        $conducteur_id = $statement->fetch()[0];

        //data miam miam
        $ville_depart = $_POST['ville_depart'];
        $ville_arrivee = $_POST['ville_arrivee'];
        $vehicule_id = $_POST['vehicule_choisi'];
        $prix = $_POST['prix'];
        $date_depart = $_POST['date_depart'];
        $heure_depart = $_POST['heure_depart'];

        $trajet_id = ModelTrajet::insert($ville_depart, $ville_arrivee, $vehicule_id, $prix, $date_depart, $heure_depart, $conducteur_id);

        //on redirige si le trajet est non nul
        if ($trajet_id !== -1 && $trajet_id !== NULL) {
            header("Location: router1.php?action=conducteurTrajetAjouteSuccess&trajet_id=" . $trajet_id);
            exit();
        } else {
            echo "Fonctionne pas";
        }
    }

    public static function conducteurTrajetAjouteSuccess() {
        $trajet_id_choisi = htmlspecialchars($_GET['trajet_id']);
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewConducteurTrajetAjoute.php';
        require ($vue);
    }

    public static function conducteurTrajetFermer() {
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewConducteurTrajetFermer.php';
        require ($vue);
    }

    public static function conducteurTrajetFerme() {
        $database = Model::getInstance();
        $trajet_id = $_POST['trajet_id'];
        
        $query = "SELECT id FROM utilisateur WHERE login = :login";
        $statement = $database->prepare($query);
        $statement->execute(['login' => $_SESSION['login_id']]);
        $conducteur_id = $statement->fetch()[0];

        $gain = ModelTrajet::fermer($trajet_id, $conducteur_id);

        if ($gain !== -1) {
            
            $querySolde = "SELECT solde FROM utilisateur WHERE id = :id";
            $statementSolde = $database->prepare($querySolde);
            $statementSolde->execute(['id' => $conducteur_id]);
            $_SESSION['solde'] = $statementSolde->fetch()[0];

            header("Location: router1.php?action=conducteurTrajetFermeSuccess&trajet_id=" . $trajet_id . "&gain=" . $gain);
            exit();
        } else {
            echo "Fonctionne pas.";
        }
    }

    public static function conducteurTrajetFermeSuccess() {
        $trajet_id_choisi = htmlspecialchars($_GET['trajet_id']);
        $gain = htmlspecialchars($_GET['gain']);
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewConducteurTrajetFerme.php';
        require ($vue);
    }
    
    
    public static function conducteurTrajetListePassager() {
        include 'config.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trajet_id_choisi = htmlspecialchars($_POST['trajet_id']);
            $vue = $root . '/app/view/conducteur/viewConducteurTrajetPassagers.php';
        } else {
            // Si 1er accès alors ft affich la list
            $vue = $root . '/app/view/conducteur/viewConducteurSelectionTrajet.php';
        }

        if (DEBUG) {
            echo ("ControllerConducteur : conducteurTrajetListePassager : vue = $vue");
        }
        require ($vue);
    }

    public static function conducteurVehiculeListe() {
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewConducteurVehiculeListe.php';

        if (DEBUG)
            echo ("ControllerConducteur : conducteurVehiculeListe : vue = $vue");

        require ($vue);
    }

    public static function conducteurTrajetListe() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewConducteurTrajetListe.php';

        if (DEBUG)
            echo ("ControllerConducteur : conducteurTrajetListe : vue = $vue");

        require ($vue);
    }

    // --- Liste des réservations
    public static function conducteurListe() {
        $results = ModelUtilisateur::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewConducteurListe.php';
        if (DEBUG)
            echo ("ControllerConducteur : conducteurListe : vue = $vue");
        require ($vue);
    }

    public static function utilisateurAddConducteur() {
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewInsert.php';
        require ($vue);
    }

    public static function ConducteurCreated() {
        $results = ModelUtilisateur::insert(
                htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), "conducteur", "secret", htmlspecialchars($_GET['solde']));
        include 'config.php';
        $vue = $root . '/app/view/conducteur/viewInserted.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerConducteur -->
