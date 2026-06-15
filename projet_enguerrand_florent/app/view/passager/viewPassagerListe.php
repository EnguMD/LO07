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

        <div>
            <table class = "table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope = "col">date_depart</th>
                        <th scope = "col">heure_depart</th>
                        <th scope = "col">depart</th>
                        <th scope = "col">destination</th>
                        <th scope = "col">conducteur</th>
                        <th scope = "col">vehicule</th>
                        <th scope = "col">immatriculation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $requete = "SELECT trajet.date_depart, trajet.heure_depart, "
                            . "ville_dep.nom AS ville_depart, ville_arr.nom AS ville_arrivee, "
                            . "vehicule.modele, vehicule.immatriculation, "
                            . "CONCAT(conducteur.prenom, ' ', conducteur.nom) AS proprietaire "
                            . "FROM trajet, vehicule, reservation, utilisateur AS passager, utilisateur AS conducteur, ville AS ville_dep, ville AS ville_arr "
                            . "WHERE passager.login = '{$_SESSION['login_id']}' "
                            . "AND passager.id = reservation.passager_id "
                            . "AND vehicule.id = trajet.vehicule_id "
                            . "AND trajet.id = reservation.trajet_id "
                            . "AND conducteur.id = trajet.conducteur_id "
                            . "AND trajet.ville_depart = ville_dep.id "
                            . "AND trajet.ville_arrivee = ville_arr.id";
                    try {
                        $database = Model::getInstance();
                        $results = $database->query($requete);
                        $results->setFetchMode(PDO::FETCH_OBJ);
                        foreach ($results as $element) {
                            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                                    $element->date_depart,
                                    $element->heure_depart, 
                                    ucfirst($element->ville_depart), 
                                    ucfirst($element->ville_arrivee),
                                    ucfirst($element->proprietaire), 
                                    ucfirst($element->modele), 
                                    strtoupper($element->immatriculation));
                        }
                        //echo "Fonctionne.";
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