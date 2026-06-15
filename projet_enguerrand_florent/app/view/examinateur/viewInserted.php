
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <!-- ===================================================== -->
        <?php
        if ($results) {
            echo ("<h3>10 réservations aléatoires</h3>");
            echo("<ul>");
            foreach ($results as $reservation) {
                echo "<li>Réservation sur le trajet {$reservation['trajet']} par {$reservation['passager']}</li>";
            }
            echo("</ul>");
        } else {
            echo ("<h3>Problème d'insertion des trajets</h3>");
            echo ("id = " . $_GET['nom']);
        }

        echo("</div>");

        include $root . '/app/view/fragment/fragmentFooter.html';
        ?>
        <!-- ----- fin viewInserted -->    

