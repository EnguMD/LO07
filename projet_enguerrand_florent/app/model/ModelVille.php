
<!-- ----- debut ModelVille -->

<?php
require_once 'Model.php';

class ModelVille {

    // Déclaration des propriétés (bonnes pratiques PHP)
    private $id;
    private $nom;


    public function __construct($id = NULL, $nom = NULL, $modele = NULL, $annee = NULL, $immatriculation = NULL, $proprietaire_id = NULL) {
        // valeurs nulles si pas de passage de paramètres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->modele = $modele;
            $this->annee = $annee;
            $this->immatriculation = $immatriculation;
            $this->proprietaire_id = $proprietaire_id;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

   

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from ville";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
    
    public static function insert($nom) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from ville";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            // ajout d'un nouveau tuple;
            $query = "insert into ville value (:id, :nom)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
?>
<!-- ----- fin ModelVille -->
