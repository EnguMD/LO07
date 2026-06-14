
<!-- ----- debut ModelUtilisateur -->

<?php
require_once 'Model.php';

class ModelReservation {

    // Déclaration des propriétés (bonnes pratiques PHP)
    private $id;
    private $trajet_id;
    private $passager_id;

    public function __construct($id = NULL, $trajet_id = NULL, $passager_id = NULL) {
        // valeurs nulles si pas de passage de paramètres
        if (!is_null($id)) {
            $this->id = $id;
            $this->trajet_id = $trajet_id;
            $this->passager_id = $passager_id;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTrajet_id($trajet_id) {
        $this->trajet_id = $trajet_id;
    }

    public function setPassager_id($passager_id) {
        $this->passager_id = $passager_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getTrajet_id() {
        return $this->trajet_id;
    }

    public function getPassager_id() {
        return $this->passager_id;
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from trajet";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($trajet_id, $passager_id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT MAX(id) FROM reservation";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple[0];
            $id++;

            $query = "INSERT INTO reservation (id, trajet_id, passager_id) VALUES (:id, :trajet_id, :passager_id)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'trajet_id' => $trajet_id,
                'passager_id' => $passager_id]);

            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelReservation-->
