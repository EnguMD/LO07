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
        <h3>C'est GOOOOOOOOOOOOOOOOOOOOOOOOD :D</h3>
        <br>
        <div class="alert alert-success" role="alert">
            Le trajet <b>n°<?php echo $trajet_id_choisi; ?></b> a bien été clôturé et passé en statut passif.<br>
            Vous avez gagné <b><?php echo $gain; ?> €</b> sur cette course ! Bien ouej chef
        </div>
        <br>
        <a href="router1.php?action=conducteurTrajetListe" class="btn btn-info">Voir l'historique de mes trajets</a>
        <a href="router1.php?action=caveAccueil" class="btn btn-secondary" style="margin-left:0.5rem;">Retourner à l'accueil</a>
        <br><br>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>