
<!-- ----- debut ModelUtilisateur -->

<?php
require_once 'Model.php';

class ModelTrajet {

    // Déclaration des propriétés (bonnes pratiques PHP)
    private $id;
    private $ville_depart;
    private $ville_arrivee;
    private $conducteur_id;
    private $vehicule_id;
    private $prix;
    private $date_depart;
    private $heure_depart;
    private $statut;

    public function __construct($id = NULL, $ville_depart = NULL, $ville_arrivee = NULL, $conducteur_id = NULL, $vehicule_id = NULL, $prix = NULL, $date_depart = NULL, $heure_depart = NULL, $statut = NULL) {
        // valeurs nulles si pas de passage de paramètres
        if (!is_null($id)) {
            $this->id = $id;
            $this->ville_depart = $ville_depart;
            $this->ville_arrivee = $ville_arrivee;
            $this->conducteur_id = $conducteur_id;
            $this->vehicule_id = $vehicule_id;
            $this->prix = $prix;
            $this->date_depart = $date_depart;
            $this->heure_depart = $heure_depart;
            $this->statut = $statut;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setVille_depart($ville_depart) {
        $this->ville_depart = $ville_depart;
    }

    public function setVille_arrivee($ville_arrivee) {
        $this->ville_arrivee = $ville_arrivee;
    }

    public function setConducteur_id($conducteur_id) {
        $this->conducteur_id = $conducteur_id;
    }

    public function setVehicule_id($vehicule_id) {
        $this->vehicule_id = $vehicule_id;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setDate_depart($date_depart) {
        $this->date_depart = $date_depart;
    }

    public function setHeure_depart($heure_depart) {
        $this->heure_depart = $heure_depart;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function getId() {
        return $this->id;
    }

    public function getVille_depart() {
        return $this->ville_depart;
    }

    public function getVille_arrivee() {
        return $this->ville_arrivee;
    }

    public function getConducteur_id() {
        return $this->conducteur_id;
    }

    public function getVehicule_id() {
        return $this->vehicule_id;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getDate_depart() {
        return $this->date_depart;
    }

    public function getHeure_depart() {
        return $this->heure_depart;
    }

    public function getStatut() {
        return $this->statut;
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from trajet";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelTrajet");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($ville_depart, $ville_arrivee, $vehicule_id, $prix, $date_depart, $heure_depart, $conducteur_id) {
        try {
            $database = Model::getInstance();

            $query = "SELECT MAX(id) FROM trajet";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple[0];
            $id++;

            $queryInsert = "INSERT INTO trajet (id, ville_depart, ville_arrivee, date_depart, heure_depart, prix, conducteur_id, vehicule_id, statut) "
                    . "VALUES (:id, :ville_depart, :ville_arrivee, :date_depart, :heure_depart, :prix, :conducteur_id, :vehicule_id, 'actif')";

            $statementInsert = $database->prepare($queryInsert);
            $statementInsert->execute([
                'id' => $id,
                'ville_depart' => $ville_depart, 'ville_arrivee' => $ville_arrivee,
                'date_depart' => $date_depart, 'heure_depart' => $heure_depart,
                'prix' => $prix,
                'conducteur_id' => $conducteur_id, 'vehicule_id' => $vehicule_id
            ]);

            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function fermer($trajet_id, $conducteur_id) {
        try {
            $database = Model::getInstance();
            $database->beginTransaction();

            //prix
            $queryPrix = "SELECT prix FROM trajet WHERE id = :id";
            $statementPrix = $database->prepare($queryPrix);
            $statementPrix->execute(['id' => $trajet_id]);
            $prix = $statementPrix->fetch()[0];

            //Nbpassager
            $queryNbPassager = "SELECT COUNT(*) FROM reservation WHERE trajet_id = :id";
            $statementNbPassager = $database->prepare($queryNbPassager);
            $statementNbPassager->execute(['id' => $trajet_id]);
            $nbPassagers = $statementNbPassager->fetch()[0];

            //Gain total
            $gain = $prix * $nbPassagers;

            //donne au cdteur
            if ($gain > 0) {
                $queryUpdateSolde = "UPDATE utilisateur SET solde = solde + :gain WHERE id = :id";
                $statementUpdateSolde = $database->prepare($queryUpdateSolde);
                $statementUpdateSolde->execute([
                    'gain' => $gain,
                    'id' => $conducteur_id ]);
            }

            // tej les res
            $queryDeleteRes = "DELETE FROM reservation WHERE trajet_id = :id";
            $statementDeleteRes = $database->prepare($queryDeleteRes);
            $statementDeleteRes->execute(['id' => $trajet_id]);

            // ->passif
            $queryUpdateStatut = "UPDATE trajet SET statut = 'passif' WHERE id = :id";
            $statementUpdateStatut = $database->prepare($queryUpdateStatut);
            $statementUpdateStatut->execute(['id' => $trajet_id]);

            // all good
            $database->commit();
            return $gain;

        } catch (PDOException $e) {
            //ou on rollback si y a un pbm
            $database->rollBack();
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    
}
?>
}
?>
<!-- ----- fin ModelTrajet-->
