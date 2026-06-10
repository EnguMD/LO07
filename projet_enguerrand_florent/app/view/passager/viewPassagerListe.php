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
                    echo('<div class="mt-4 p-5 bg-primary text-white rounded">');
                    $requete = "select * from trajet where passager_id = $SESSION[login_id]";
                    echo ('<h3> Vérification de la transaction avec ' . $requete . '</h3>');
                    try {
                        $resultats = $database->query($requete);
                        $row = $resultats->fetch();
                        if (!$row) {
                            foreach ($results as $element) {
                        printf("<tr><td>%Y-%m-%d</td><td>%T</td><td>%s</td><td>%s</td>td>%s</td>td>%s</td>td>%s</td></tr>", $element->getDate_depart(),
                                $element->getHeure_depart(), $element->getVille_depart(), $element->getVille_arrivee(),
                                $element->getProprietaire(), $element->getModele(), $element->getImmatriculation());
                    }
                            echo "Fonctionne.";
                        }
                    } catch (Exception $ex) {
                        echo'fonctionne pas';
                    }
                    ?>
                    </div>  
                </tbody>
            </table>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>