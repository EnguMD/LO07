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

        <h3>El garage 😎😎</h3>
        <br>
        <div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Marque</th>
                        <th scope="col">Modèle</th>
                        <th scope="col">Année</th>
                        <th scope="col">Immatriculation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // On cible uniquement le véhicule où le proprietaire_id correspond à l'id du login en session
                    $requete = "SELECT vehicule.marque, vehicule.modele, vehicule.annee, vehicule.immatriculation "
                            . "FROM vehicule, utilisateur "
                            . "WHERE utilisateur.login = '{$_SESSION['login_id']}' "
                            . "AND vehicule.proprietaire_id = utilisateur.id "
                            . "ORDER BY vehicule.marque ASC";

                    try {
                        $database = Model::getInstance();
                        $results = $database->query($requete);
                        $results->setFetchMode(PDO::FETCH_OBJ);

                        foreach ($results as $element) {
                            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                                    ucfirst($element->marque),
                                    ucfirst($element->modele),
                                    $element->annee,
                                    strtoupper($element->immatriculation));
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