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
            // On affiche le numéro récupéré par le contrôleur
            echo "Le trajet n°" . $trajet_id_choisi . " a bien été ajouté ! 😁😁😁😁"
            ?>
        </h3>
        <br><br>
        <a href="router1.php?action=conducteurTrajetListe" class="btn btn-info">Voir mes trajets</a>
        <a href="router1.php?action=caveAccueil" class="btn btn-secondary" style="margin-left:0.5rem;">Retourner à l'accueil</a>
        <br><br>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>
</body>