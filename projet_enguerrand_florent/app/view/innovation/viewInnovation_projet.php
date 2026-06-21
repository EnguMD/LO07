
<!-- ----- début innovation_projet -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <h3>Innovation Projet</h3>
        <p>Nous avons rajouté une barre de recherche des villes, pour trouver un trajet passant par cette ville.
        Nous avons également empêché une réservation si le solde est insuffisant.</p>
        
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin innovation_projet -->


