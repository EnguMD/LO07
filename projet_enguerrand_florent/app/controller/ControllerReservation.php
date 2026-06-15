<?php

require_once '../model/ModelTrajet.php';
require_once '../model/ModelReservation.php';
require_once '../model/Model.php';

class ControllerReservation {

    public static function passagerReserve() {
        $database = Model::getInstance();
        $trajet_id_choisi = $_POST['reservationTrajet'];

        $query = "SELECT id FROM utilisateur WHERE login = :login";
        $statement = $database->prepare($query);
        $statement->execute([
            'login' => $_SESSION['login_id']]);

        $tuple = $statement->fetch();
        $passager_id = $tuple[0];
        $resultat = ModelReservation::insert($trajet_id_choisi, $passager_id);
        if ($resultat !== -1) {
            $querySolde = "SELECT solde FROM utilisateur WHERE id = :id";
            $statementSolde = $database->prepare($querySolde);
            $statementSolde->execute(['id' => $passager_id]);

            $nouveauSolde = $statementSolde->fetch()[0];

            $_SESSION['solde'] = $nouveauSolde;
//solde refreshé dans la barre de fragmentmenu.php
            header("Location: router1.php?action=passagerReserveSuccess&trajet_id=" . $trajet_id_choisi);
            exit();
            //on affiche pas de suite la vue, empêche de re-réserver avec ctrl+r
        } else {
            
        }
    }

    public static function passagerReserveSuccess() {
        $trajet_id_choisi = $_GET['trajet_id'];
        include 'config.php';
        $vue = $root . '/app/view/passager/viewPassagerReserve.php';
        require ($vue);
    }
}
?>