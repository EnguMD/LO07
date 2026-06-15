
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
                    <th scope = "col">Nom</th>
                </tr>
            </thead>
            <tbody>
                <h5 class='card-title'>Liste des villes :</h5>
                <?php
                // La liste des vins est dans une variable $results             
                foreach ($results as $element) {
                    printf("<tr><td>%s</td></tr>", $element->getNom());
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewAll -->


