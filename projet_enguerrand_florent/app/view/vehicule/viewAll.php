
<!-- ----- début viewAll -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope = "col">Marque</th>
                    <th scope = "col">Modèle</th>
                    <th scope = "col">Année</th>
                    <th scope = "col">Immatriculation</th>
                    <th scope = "col">Propriétaire</th>
                </tr>
            </thead>
            <tbody>
                <h5 class='card-title'>Liste des véhicules :</h5>
                <?php
                // La liste des vins est dans une variable $results             
                foreach ($results as $element) {
                    printf("<tr><td>%s</td><td>%s</td><td>%d</td><td>%s</td><td>%s</td></tr>", $element->getMarque(),
                            $element->getModele(), $element->getAnnee(), $element->getImmatriculation(), $element->getProprietaire());
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewAll -->


