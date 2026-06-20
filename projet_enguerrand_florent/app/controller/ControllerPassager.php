<!-- ----- debut ControllerPassager -->
<?php

class ControllerPassager {

    // --- Liste des réservations
    public static function passagerListe() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewPassagerListe.php';
        if (DEBUG)
            echo ("ControllerPassager : passagerListe : vue = $vue");
        require ($vue);
    }
    
    public static function passagerReservation() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewPassagerReservation.php';
        if (DEBUG)
             echo ("ControllerPassager : passagerReservation : vue = $vue");
        require ($vue);
    }
    
    public static function passagerReserve() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewPassagerReserve.php';
        if (DEBUG)
             echo ("ControllerPassager : passagerReserve: vue = $vue");
        require ($vue);
    }
    public static function passagerRechercheTrajet() {
        include 'config.php';
        $vue = $root . '/app/view/passager/viewPassagerRechercheTrajetReservation.php';
        if (DEBUG)
            echo ("ControllerPassager : passagerRechercheTrajet : vue = $vue");
        require ($vue);
    }

    // Affiche le formulaire de creation d'un vin
    public static function utilisateurAddPassager() {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/passager/viewInsert.php';
        if(DEBUG)
             echo ("ControllerPassager : utilisateurAddPassager : vue = $vue");
        require ($vue);
    }
    
    public static function PassagerCreated() {
        $results = ModelUtilisateur::insert(
                htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), "passager", "secret", htmlspecialchars($_GET['solde']) );
        include 'config.php';
        $vue = $root . '/app/view/passager/viewInserted.php';
        require ($vue);
    }
}
?>
<!-- ----- fin ControllerPassager -- -->
