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
        echo "Réservation pour le trajet n°" . $trajet_id_choisi ." confirmée :)"
        ?>
            <br>
            Vous pouvez regardez directement depuis ici toutes vos réservations !</h3><br>
        <a href="../router1.php?action=passagerListe"><h4>Voir mes réservations</h4></a>

    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>