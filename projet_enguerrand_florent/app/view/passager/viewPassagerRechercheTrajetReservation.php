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
        // htmlspecchars car entrée de texte
        $rechercheTexte = htmlspecialchars($_POST['rechercheVille']);
        //technique stylé 😎
        $rechercheSQL = "%" . $rechercheTexte . "%";

        // rqt like
        $requete = "SELECT trajet.id AS trajet_id, ville_dep.nom AS ville_depart, ville_arr.nom AS ville_arrivee, trajet.date_depart, trajet.heure_depart, trajet.statut, trajet.prix, passager.solde "
                . "FROM trajet, vehicule, utilisateur AS passager, utilisateur AS conducteur, ville AS ville_dep, ville AS ville_arr "
                . "WHERE passager.login = :login "
                . "AND trajet.statut = 'actif' "
                . "AND vehicule.id = trajet.vehicule_id "
                . "AND conducteur.id = trajet.conducteur_id "
                . "AND trajet.ville_depart = ville_dep.id "
                . "AND trajet.ville_arrivee = ville_arr.id "
                . "AND (ville_dep.nom LIKE :recherche OR ville_arr.nom LIKE :recherche)";

        echo ("<h3>Résultats de recherche pour : <em>" . $rechercheTexte . "</em></h3><br>");

        //idem que pour la reserv de trajet passager, juste interface diff (radio)
        try {
            $database = Model::getInstance();

            $statement = $database->prepare($requete);
            $statement->execute([
                'login' => $_SESSION['login_id'],
                'recherche' => $rechercheSQL
            ]);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $results = $statement->fetchAll();

            if (count($results) > 0) {
                echo "<form method='post' action='router1.php?action=passagerReserve'>";

                echo "<div class='form-group mb-4'>";

                foreach ($results as $element) {
                    $attribut_disabled = '';
                    $message_solde = '';

                    if ($element->solde < $element->prix) {
                        $attribut_disabled = 'disabled';
                        $message_solde = " (SOLDE INSUFFISANT)";
                    }

                    printf("<div class='form-check'>
                        <label class='btn btn-outline-primary mb-3' for='trajet_%s'>
                        <input type='radio' class='form-check-input'  name='reservationTrajet' id='trajet_%s' value='%s' autocomplete='off' required>
                                %s --> %s le %s à %s pour %s € %s
                            </label>
                        </div>",
                            $element->trajet_id, $element->trajet_id, $attribut_disabled,
                            $element->trajet_id, ucfirst($element->ville_depart),
                            ucfirst($element->ville_arrivee), $element->date_depart,
                            $element->heure_depart, $element->prix, $message_solde);
                }

                echo "</div>";

                echo "<button class='btn btn-primary' type='submit'>Réserver le trajet</button>";
                echo "<button class='btn btn-secondary' type='reset' style='margin-left:0.5rem'>Reset</button>";
                echo "<br><br>";
                echo "</form>";
            } else {
                echo "<div class='alert alert-warning'>Aucun trajet actif ne correspond à votre recherche de ville.</div>";
                echo "<br>";
                echo "<a href='router1.php?action=passagerReservation' class='btn btn-secondary'>Voir tous les trajets actifs</a>";
            }
        } catch (Exception $ex) {
            echo "Erreur : " . $ex->getMessage();
        }
        ?>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>