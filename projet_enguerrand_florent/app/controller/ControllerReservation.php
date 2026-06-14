<!-- ----- debut ControllerReservation -->
<?php
require_once '../model/ModelTrajet.php';
require_once '../model/ModelReservation.php';

class ControllerReservation {

    public static function passagerReserve() {
        $trajet_id_choisi = $_POST['reservationTrajet'];
        $passager_id = $_SESSION['login_id'];
        $resultat = ModelReservation::insert($trajet_id_choisi,$passager_id);
        include 'config.php';
        $vue = $root . 'app/view/passager/viewPassagerReserve.php';
        if (DEBUG)
            echo ("ControllerVin : vinReadAll : vue = $vue");
        require ($vue);
    }
}
?>


