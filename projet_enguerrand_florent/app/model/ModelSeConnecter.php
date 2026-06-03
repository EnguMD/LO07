
<!-- ----- debut ModelSeConnecter -->

<?php
require_once 'Model.php';
require_once 'ModelUtilisateur.php';

class ModelSeConnecter {

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
            $query = "select * from utilisateur where login = :user_login";
            $statement = $database->prepare($query);
            $statement->execute([
                'user_login' => $user_login,
            ]);
            $results = $statement->setFetchMode(PDO::FETCH_CLASS, "ModelUtilisateur");
            $user = $statement->fetch();
            if ($user->getPassword() === $user_password) {
                return $user;
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