
<!-- ----- debut ModelVehicule -->

<?php
require_once 'Model.php';

class ModelVehicule {

    // Déclaration des propriétés (bonnes pratiques PHP)
    private $id;
    private $marque;
    private $modele;
    private $annee;
    private $immatriculation;
    private $proprietaire;

    public function __construct($id = NULL, $marque = NULL, $modele = NULL, $annee = NULL, $immatriculation = NULL, $proprietaire = NULL) {
        // valeurs nulles si pas de passage de paramètres
        if (!is_null($id)) {
            $this->id = $id;
            $this->marque = $marque;
            $this->modele = $modele;
            $this->annee = $annee;
            $this->immatriculation = $immatriculation;
            $this->proprietaire = $proprietaire;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function setModele($modele) {
        $this->modele = $modele;
    }

    public function setAnnee($annee) {
        $this->annee = $annee;
    }

    public function setImmatriculation($immatriculation) {
        $this->immatriculation = $immatriculation;
    }

    public function setProprietaire($proprietaire) {
        $this->proprietaire = $proprietaire;
    }

    public function getId() {
        return $this->id;
    }

    public function getMarque() {
        return $this->marque;
    }

    public function getModele() {
        return $this->modele;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function getImmatriculation() {
        return $this->immatriculation;
    }

    public function getProprietaire() {
        return $this->proprietaire;
    }


    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select marque, modele, annee, immatriculation, 
                CONCAT(prenom, ' ', nom) AS proprietaire
                      from vehicule, utilisateur 
                      where vehicule.proprietaire_id = utilisateur.id
                      order by proprietaire";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelVehicule -->
