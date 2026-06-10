
<!-- ----- debut ModelUtilisateur -->

<?php
require_once 'Model.php';

class ModelUtilisateur {

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

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setVille_arrivee($ville_arrivee) {
        $this->ville_arrivee = $ville_arrivee;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSolde($solde) {
        $this->solde = $solde;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getVille_arrivee() {
        return $this->ville_arrivee;
    }

    public function getRole() {
        return $this->role;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSolde() {
        return $this->solde;
    }

    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from utilisateur";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelUtilisateur -->
