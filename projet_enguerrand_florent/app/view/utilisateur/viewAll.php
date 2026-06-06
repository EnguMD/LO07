
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
                    <th scope = "col">Prénom</th>
                    <th scope = "col">Rôle</th>
                    <th scope = "col">Login</th>
                    <th scope = "col">Password</th>
                    <th scope = "col">Solde</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // La liste des vins est dans une variable $results             
                foreach ($results as $element) {
                    printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%.2f</td></tr>", $element->getNom(),
                            $element->getPrenom(), $element->getRole(), $element->getLogin(), $element->getPassword(), $element->getSolde());
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewAll -->


