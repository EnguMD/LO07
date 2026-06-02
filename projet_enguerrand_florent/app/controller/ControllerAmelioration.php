
<!-- ----- debut ControllerAmelioration -->
<?php

class ControllerAmelioration {


 // --- Liste des vins
 public static function amelioration() {
  include 'config.php';
  $vue = $root . '/app/view/documentation/amelioration.php';
  if (DEBUG)
   echo ("ControllerVin : vinReadAll : vue = $vue");
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerAmelioration -->


