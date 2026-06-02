
<!-- ----- debut ModelSeConnecter -->

<?php
require_once 'Model.php';

class ModelSeConnecter {

    private $id, $nom, $prenom, $region;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $region = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->region = $region;
        }
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setRegion($region) {
        $this->region = $region;
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getRegion() {
        return $this->region;
    }

    public static function connect($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from producteur where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProducteur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function connected($user_login, $user_password) {
        try {
            $database = Model::getInstance();
            $query = "select password from utilisateur where login = :user_login";
            $statement = $database->prepare($query);
            $statement->execute([
                'user_login' => $user_login,
            ]);
            $results = $statement->fetchColumn();
            if ($results === $user_password) {
                return $user_login;
            } else {
                return -1;
            }
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelSeConnecter -->