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

        <h3>Los trajetos mon gars !!!!</h3>
        <br>
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Date de départ</th>
                        <th scope="col">Heure de départ</th>
                        <th scope="col">Départ</th>
                        <th scope="col">Arrivée</th>
                        <th scope="col">Véhicule</th>
                        <th scope="col">Immatriculation</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // On cible uniquement les trajets liés à l'utilisateur connecté
                    $requete = "SELECT trajet.date_depart, trajet.heure_depart, "
                            . "ville_dep.nom AS ville_depart, ville_arr.nom AS ville_arrivee, "
                            . "vehicule.modele, vehicule.immatriculation, trajet.prix, trajet.statut "
                            . "FROM trajet, vehicule, utilisateur AS conducteur, ville AS ville_dep, ville AS ville_arr "
                            . "WHERE conducteur.login = '{$_SESSION['login_id']}' "
                            . "AND trajet.conducteur_id = conducteur.id "
                            . "AND trajet.vehicule_id = vehicule.id "
                            . "AND trajet.ville_depart = ville_dep.id "
                            . "AND trajet.ville_arrivee = ville_arr.id "
                            . "ORDER BY statut ASC, trajet.date_depart DESC, trajet.heure_depart DESC";

                    try {
                        $database = Model::getInstance();
                        $results = $database->query($requete);
                        $results->setFetchMode(PDO::FETCH_OBJ);

                        foreach ($results as $element) {
                            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s €</td><td>%s</td></tr>",
                                    $element->date_depart,
                                    $element->heure_depart,
                                    ucfirst($element->ville_depart),
                                    ucfirst($element->ville_arrivee),
                                    ucfirst($element->modele),
                                    strtoupper($element->immatriculation),
                                    $element->prix,
                                    ucfirst($element->statut));
                        }
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <a href="router1.php?action=caveAccueil" class="btn btn-secondary" style="margin-left:0.5rem;">Retourner à l'accueil</a>
            <br><br>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>