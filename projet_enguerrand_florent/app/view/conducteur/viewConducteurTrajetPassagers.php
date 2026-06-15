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

        <h3>Liste des passagers pour le trajet n°<?php echo $trajet_id_choisi; ?></h3>
        <br>
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nom du Passager</th>
                        <th scope="col">Prénom du Passager</th>
                        <th scope="col">Login</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Requête de jonction pour trouver les utilisateurs (passagers) liés aux réservations du trajet sélectionné
                    $requete = "SELECT passager.nom, passager.prenom, passager.login "
                            . "FROM reservation, utilisateur AS passager "
                            . "WHERE reservation.trajet_id = $trajet_id_choisi "
                            . "AND reservation.passager_id = passager.id "
                            . "ORDER BY passager.nom ASC";

                    try {
                        $database = Model::getInstance();
                        $results = $database->query($requete);
                        $results->setFetchMode(PDO::FETCH_OBJ);

                        // Compteur pour vérifier s'il y a des passagers
                        $nbPassagers = 0;

                        foreach ($results as $element) {
                            $nbPassagers++;
                            printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                                    strtoupper($element->nom),
                                    ucfirst($element->prenom),
                                    $element->login);
                        }

                        // Si le tableau est resté vide
                        if ($nbPassagers === 0) {
                            echo "<tr><td colspan='3' class='text-center text-danger'>Aucun passager n'a encore réservé ce trajet.</td></tr>";
                        }
                    } catch (Exception $ex) {
                        echo "Erreur lors de la récupération : " . $ex->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="router1.php?action=conducteurTrajetListePassager" class="btn btn-success">Retour à la sélection</a>
        <a href="router1.php?action=caveAccueil" class="btn btn-secondary" style="margin-left:0.5rem;">Retourner à l'accueil</a>
        <br><br>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>