<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- ----- début viewSuperglobales -->
<?php

require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.php';
      include $root . '/app/view/fragment/fragmentJumbotron.html';
      ?>

      <div>
          <?php

      $superglobales = array("\$_COOKIE" => $_COOKIE, "\$_SESSION" => $_SESSION);

      foreach ($superglobales as $label => $globale) {
          if (true) {
              
              ksort ($globale);


              echo("<div class='card'>");
              echo("<div class='card-body bg-info'>");
              echo("<h5 class='card-title'>SuperGlobale : $label</h5>");

              echo("<div class = 'col-4'>");
              echo("<table class = 'table table-bordered'>");
              echo("<thead>");
              echo("<tr>");
              echo("<th>#</th>");
              echo("<th>clé</th>");
              echo("<th>valeur</th>");
              echo("</tr>");
              echo("</thead>");

              $compteur = 0;
              echo ("<tbody>");
              foreach ($globale as $cle => $valeur) {
                  $compteur++;
                  echo ("<tr>");
                  echo("<th scope='row'>$compteur</th>");
                  echo ("<td>$cle</td>");

                  if (is_array($valeur)) {
                      $liste = implode(", ", $valeur);
                      echo ("<td>$liste</td</tr>");
                  } else {
                      echo ("<td>$valeur</td>");
                      echo ("</tr>");
                  }
              }
              echo ("</tbody>");
              echo ("</table>");
              echo ("</div>");
              echo ("</div>");
              echo ("</div>");
          }
      }
      ?>
      </div>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

  <!-- ----- fin viewSuperglobales -->
  
  
  