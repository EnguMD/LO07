<!-- ----- debut ControllerInnovation -->
<?php

class ControllerInnovation {

    public static function innovation_MVC() {
        include 'config.php';
        $vue = $root . '/app/view/innovation/viewInnovation_MVC.php';

        if (DEBUG)
            echo ("ControllerInnovation : innovation_MVC : vue = $vue");

        require ($vue);
    }

    public static function innovation_projet() {
        include 'config.php';
        $vue = $root . '/app/view/innovation/viewInnovation_projet.php';

        if (DEBUG)
            echo ("ControllerInnovation : innovation_projet : vue = $vue");

        require ($vue);
    }

    
}
?>
<!-- ----- fin ControllerInnovation -->
