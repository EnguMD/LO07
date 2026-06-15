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

        <h3>Sélectionner un trajet pour voir ses passagers</h3>
        <br>
        <?php
        $requete = "SELECT trajet.id AS trajet_id, ville_dep.nom AS ville_depart, ville_arr.nom AS ville_arrivee, trajet.date_depart, trajet.heure_depart "
                . "FROM trajet, utilisateur AS conducteur, ville AS ville_dep, ville AS ville_arr "
                . "WHERE conducteur.login = '{$_SESSION['login_id']}' "
                . "AND trajet.conducteur_id = conducteur.id "
                . "AND trajet.ville_depart = ville_dep.id "
                . "AND trajet.ville_arrivee = ville_arr.id "
                . "ORDER BY trajet.date_depart DESC";

        try {
            $database = Model::getInstance();
            $results = $database->query($requete);
            $results->setFetchMode(PDO::FETCH_OBJ);

            echo "<form method='post' action='router1.php?action=conducteurTrajetListePassager'>";
            echo "<div class='form-group'>";
            echo "<select class='form-control' name='trajet_id' id='trajet_id' required>";
            echo "<option value='' selected disabled>------------------------------Sélectionnez un trajet------------------------------</option>";

            foreach ($results as $element) {
                printf("<option value='%s'>Trajet %s : %s --> %s le %s à %s</option>",
                        $element->trajet_id,
                        $element->trajet_id,
                        ucfirst($element->ville_depart),
                        ucfirst($element->ville_arrivee),
                        $element->date_depart,
                        $element->heure_depart);
            }

            echo "</select>";
            echo "</div><br>";
            echo "<input class='btn btn-primary' type='submit' value='Voir les passagers'>";
            echo"<br><br>";
            echo "</form>";
        } catch (Exception $ex) {
            echo "Erreur : " . $ex->getMessage();
        }
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>