
<!-- ----- debut ControllerExaminateur -->
<?php

class ControllerExaminateur {


 // --- Liste des vins
 public static function superglobales() {
  include 'config.php';
  $vue = $root . '/app/view/examinateur/viewSuperglobales.php';
  if (DEBUG)
   echo ("ControllerExaminateur : vue = $vue");
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerExaminateur -->


