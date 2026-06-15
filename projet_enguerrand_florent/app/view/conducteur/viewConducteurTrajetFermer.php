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

        <h3>Clôturer un trajet actif</h3>
        <br>
        <?php
        $aujourdhui = date('Y-m-d'); //on recup pour faire le delta

        $requete = "SELECT trajet.id AS trajet_id, ville_dep.nom AS ville_depart, ville_arr.nom AS ville_arrivee, trajet.date_depart, trajet.heure_depart "
                . "FROM trajet, utilisateur AS conducteur, ville AS ville_dep, ville AS ville_arr "
                . "WHERE conducteur.login = '{$_SESSION['login_id']}' "
                . "AND trajet.conducteur_id = conducteur.id "
                . "AND trajet.statut = 'actif' "
                . "AND trajet.ville_depart = ville_dep.id "
                . "AND trajet.ville_arrivee = ville_arr.id "
                . "ORDER BY trajet.date_depart ASC";

        try {
            $database = Model::getInstance();
            $results = $database->query($requete);
            $results->setFetchMode(PDO::FETCH_OBJ);

            echo "<form method='post' action='router1.php?action=conducteurTrajetFerme'>";
            echo "<div class='form-group'>";
            echo "<label for='trajet_id'><b>Sélectionnez le trajet à terminer :</b></label><br>";
            echo "<select class='form-control' name='trajet_id' id='trajet_id' required>";
            echo "<option value='' selected disabled>------------------------------Sélectionnez un trajet------------------------------</option>";

            foreach ($results as $element) {
                $attribut_disabled = '';
                $message_date = '';

                //si trajet pas encore passé on empêche de cash out l'argent
                if ($element->date_depart > $aujourdhui) {
                    $attribut_disabled = 'disabled';
                    $message_date = " XXX(DATE PAS ENCORE ATTEINTE)XXX";
                }

                printf("<option value='%s' %s>%s --> %s le %s à %s%s</option>",
                        $element->trajet_id,
                        $attribut_disabled,
                        ucfirst($element->ville_depart),
                        ucfirst($element->ville_arrivee),
                        $element->date_depart,
                        $element->heure_depart,
                        $message_date);
            }

            echo "</select>";
            echo "</div><br>";
            echo "<input class='btn btn-warning' type='submit' value='Fermer le trajet et récupérer la tuneeeeeeee'>";
            echo"<br><br>";
            echo "</form>";
        } catch (Exception $ex) {
            echo "Erreur : " . $ex->getMessage();
        }
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>