
<!-- ----- début viewInnovation_MVC -->
<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>

        <h3>Innovation MVC</h3>
        <p>De nombreuses vues sont redondantes, notamment l'ajout d'un nouvel élément d'une table(utilisateur, ville, véhicule).
            Nous pourrions utiliser une vue table qui gère l'ensemble des vues communes de chaque BDD.</p>
        
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewInnovation_MVC -->


