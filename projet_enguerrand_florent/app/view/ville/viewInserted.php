
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
     echo ("<h3>La nouvelle ville a été ajoutée</h3>");
     echo("<ul>");
     echo ("<li>id = " . $results . "</li>");
     echo ("<li>nom = " . $_GET['nom'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion de la ville</h3>");
     echo ("id = " . $_GET['nom']);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    