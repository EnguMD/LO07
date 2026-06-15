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
        <h3>
            <?php
            echo "Réservation pour le trajet n°" . $trajet_id_choisi . " confirmée :)"
            ?>
            <br><br>
            <a href="router1.php?action=passagerListe" class="btn btn-info">Voir mes réservations</a>
            <a href="router1.php?action=" class="btn btn-secondary" style="margin-left:0.1rem;">Retourner à l'accueil</a>
            <br><br>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>