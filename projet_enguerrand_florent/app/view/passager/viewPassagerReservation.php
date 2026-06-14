<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>


        <?php
        $requete = "SELECT trajet.id AS trajet_id, depart.nom AS ville_depart, arrivee.nom AS ville_arrivee, trajet.date_depart, trajet.heure_depart, trajet.statut, trajet.prix "
                . "FROM trajet, ville AS depart, ville AS arrivee "
                . "WHERE statut = 'actif' "
                . "AND trajet.ville_depart = depart.id "
                . "AND trajet.ville_arrivee = arrivee.id";

        echo ('<h3> Réserver ma poule ? </h3>');
        try {
            $database = Model::getInstance();
            $results = $database->query($requete);
            $results->setFetchMode(PDO::FETCH_OBJ);
            echo"<form method='post' action='router1.php?action=passagerReserve'>";
            echo"<select name=reservationTrajet id=reservationTrajet>";
            echo"<option value='' selected disabled>----------------------------Sélectionnez un trajet----------------------------</option>";
            foreach ($results as $element) {
                printf("<option value = %s >%s -->  %s le %s à %s pour %s</option>",
                        $element->trajet_id, $element->ville_depart, $element->ville_arrivee,
                        $element->date_depart, $element->heure_depart, $element->prix);
                
            }
            echo"</select>";
            echo"<br>";
            echo"<input class='btn btn-primary' type='submit' value='Submit'>";
            echo"</form>";
        } catch (Exception $ex) {
            echo $ex->getMessage();
            echo 'fonctionne pas.';
        }
        ?>


    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>