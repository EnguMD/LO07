
<!-- ----- debut ModelReservation -->

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
            $query = "select * from reservation";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
public static function insert_alea() {
        try {
            $database = Model::getInstance();
            $nb_reservation=0;
            while($nb_reservation<=10) {
                $nb_reservation++;
                // recherche de la valeur de la clé = max(id) + 1
                $query = "select max(id) from reservation";
                $statement = $database->query($query);
                $tuple = $statement->fetch();
                $id = $tuple['0'];
                $id++;

                //trouver un trajet au pif
                $query = "select id from trajet";
                $statement = $database->query($query);
                $data = $statement->fetchAll(PDO::FETCH_COLUMN);
                $trajet_id = $data[array_rand($data)];

                //trouver un passager au pif
                $query = "select id from utilisateur where role = 'passager'";
                $statement = $database->query($query);
                $data = $statement->fetchAll(PDO::FETCH_COLUMN);
                $passager_id = $data[array_rand($data)];

                // ajout d'un nouveau tuple;
                $query = "insert into reservation value (:id, :trajet_id, :passager_id)";
                $statement = $database->prepare($query);
                $statement->execute([
                    'id' => $id,
                    'trajet_id' => $trajet_id,
                    'passager_id' => $passager_id,
                ]);

                $query = "SELECT CONCAT(vd.nom, '-->', va.nom) AS resultat
                        FROM trajet t
                        JOIN ville vd ON vd.id = t.ville_depart
                        JOIN ville va ON va.id = t.ville_arrivee
                        WHERE t.id = :trajet_id
                        ";
                $statement = $database->prepare($query);
                $statement->execute(['trajet_id' => $trajet_id]);
                $trajet = $statement->fetchColumn();

                $query = "select CONCAT(prenom, ' ', nom)
                        from utilisateur
                        where id = :passager_id";
                $statement = $database->prepare($query);
                $statement->execute(['passager_id' => $passager_id]);
                $passager = $statement->fetchColumn();

                $results[] = [
                    'trajet' => $trajet,
                    'passager' => $passager
                ];
            }

            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
    public static function insert($trajet_id, $passager_id) {
        try {
            $database = Model::getInstance();

            //Permet de freeze la bdd
            $database->beginTransaction();

            //Créer nvl res avec id unique
            $query = "SELECT MAX(id) FROM reservation";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple[0];
            $id++;

            // Reservation dans sa table
            $queryInsert = "INSERT INTO reservation (id, trajet_id, passager_id) VALUES (:id, :trajet_id, :passager_id)";
            $statementInsert = $database->prepare($queryInsert);
            $statementInsert->execute([
                'id' => $id,
                'trajet_id' => $trajet_id,
                'passager_id' => $passager_id
            ]);

            //Mise a jour du solde
            $queryUpdate = "UPDATE utilisateur SET solde = solde - (SELECT prix FROM trajet WHERE id = :trajet_id) WHERE id = :passager_id";
            $statementUpdate = $database->prepare($queryUpdate);
            $statementUpdate->execute([
                'trajet_id' => $trajet_id,
                'passager_id' => $passager_id
            ]);

            // Tout est nickel on valide dans la bdd
            $database->commit();
            return $id;
        } catch (PDOException $e) {

            //Si problème on rollback
            $database->rollBack();
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelReservation-->
