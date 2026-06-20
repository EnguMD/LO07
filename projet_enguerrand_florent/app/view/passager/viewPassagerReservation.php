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
        $requete = "SELECT trajet.id AS trajet_id, ville_dep.nom AS ville_depart, ville_arr.nom AS ville_arrivee, trajet.date_depart, trajet.heure_depart, trajet.statut, trajet.prix, passager.solde "
                . "FROM trajet, vehicule, utilisateur AS passager, utilisateur AS conducteur, ville AS ville_dep, ville AS ville_arr "
                . "WHERE passager.login = '{$_SESSION['login_id']}' "
                . "AND trajet.statut = 'actif' "
                . "AND vehicule.id = trajet.vehicule_id "
                . "AND conducteur.id = trajet.conducteur_id "
                . "AND trajet.ville_depart = ville_dep.id "
                . "AND trajet.ville_arrivee = ville_arr.id";

        echo ('<h3> Réserver ma poule ? </h3>');
        try {
            $database = Model::getInstance();
            $results = $database->query($requete);
            $results->setFetchMode(PDO::FETCH_OBJ);
            echo"<form method='post' action='router1.php?action=passagerReserve'>";
            echo"<select class='form-select mb-3' name=reservationTrajet id=reservationTrajet required>";
            echo"<option value='' selected disabled>------------------------------Sélectionnez un trajet------------------------------</option>";

            foreach ($results as $element) {

                $attribut_disabled = '';
                $message_solde = '';

                if ($element->solde < $element->prix) {
                    $attribut_disabled = 'disabled';
                    $message_solde = "(SOLDE INSUFFISANT)";
                }

                printf("<option value='%s' %s>%s --> %s le %s à %s pour %s € %s</option>",
                        $element->trajet_id,
                        $attribut_disabled,
                        ucfirst($element->ville_depart),
                        ucfirst($element->ville_arrivee),
                        $element->date_depart,
                        $element->heure_depart,
                        $element->prix,
                        $message_solde);
            }

            echo"</select>";
            echo"<button class = 'btn btn-primary' type = 'submit'>Réserver le trajet</button>";
            echo"<button class = 'btn btn-secondary' type = 'reset' style='margin-left:0.1rem'>Reset</button>";
            echo"<br><br>";
            echo"</form>";
        } catch (Exception $ex) {
            echo $ex->getMessage();
            echo 'fonctionne pas.';
        }
        ?>


    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>