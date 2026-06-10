<!-- ----- debut ControllerPassager -->
<?php

class ControllerPassager {

    // --- Liste des réservations
    public static function passagerListe() {
        $results = ModelPassager::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewPassagerListe.php';
        if (DEBUG)
            echo ("ControllerVille : villeReadAll : vue = $vue");
        require ($vue);
    }

    // Affiche le formulaire de creation d'un vin
    public static function utilisateurAddPassager() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewInsert.php';
        require ($vue);
    }

    // Affiche un formulaire pour récupérer les informations d'un nouveau vin.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function PassagerCreated() {
        // ajouter une validation des informations du formulaire
        $results = ModelUtilisateur::insert(
                htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), "passager", "secret", htmlspecialchars($_GET['solde'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewInserted.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerVille -->
