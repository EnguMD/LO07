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
                    echo('</div>  <div class="mt-4 p-5 bg-primary text-white rounded">');
                    $requete = "select * from trajet where passager_id = $SESSION[login_id]";
                    echo ('<h3> Vérification de la transaction avec ' . $requete . '</h3>');
                    try {
                        $resultats = $database->query($requete);
                        $row = $resultats->fetch();
                        if (!$row) {
                            foreach ($results as $element) {
                        printf("<tr><td>%d</td><td>%s</td><td>%d</td><td>%.2f</td></tr>", $element->getDate_depart(),
                                $element->getHeure_depart(), $element->getDepart(), $element->getDestination(),
                                $element->getConducteur(), $element->getModele(), $element->getImmatriculation());
                    }
                            echo "Le vin avec l'id 2000 est présent.";
                        }
                    } catch (Exception $ex) {
                        
                    }

                    echo('</div>
    <div class="mt-4 p-5 bg-primary text-white rounded">');

                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>