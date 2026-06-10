
<!-- ----- debut ModelUtilisateur -->

<?php
require_once 'Model.php';

class ModelUtilisateur {

    // Déclaration des propriétés (bonnes pratiques PHP)
    private $id;
    private $nom;
    private $prenom;
    private $role;
    private $login;
    private $password;
    private $solde;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $role = NULL, $login = NULL, $password = NULL, $solde = NULL) {
        // valeurs nulles si pas de passage de paramètres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->role = $role;
            $this->login = $login;
            $this->password = $password;
            $this->solde = $solde;
        }
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
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

    public function getPrenom() {
        return $this->prenom;
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

    public static function insert($nom, $prenom, $role, $password, $solde) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from utilisateur";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
            $login = strtolower($nom . $prenom);
            // ajout d'un nouveau tuple;
            $query = "insert into utilisateur value (:id, :nom, :prenom, :role, :login, :password, :solde)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'role' => $role,
                'login' => $login,
                'password' => $password,
                'solde' => $solde
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
?>
<!-- ----- fin ModelUtilisateur -->
