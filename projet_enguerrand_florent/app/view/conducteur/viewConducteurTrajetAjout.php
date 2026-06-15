
<!-- ----- début viewConducteurTrajetAjout -->

<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?> 
        <?php
        
        
        echo"<form role='form' method='post' "
        . "action='router1.php?action=conducteurTrajetAjoute'>";
        
        
//-----------------------DEPART-------------------------
        echo"<div class='form-group mb-3'>";
        $requete = "SELECT ville.id, ville.nom "
                . "FROM ville ";
        try {
            $database = Model::getInstance();
            $results = $database->query($requete);
            $results->setFetchMode(PDO::FETCH_OBJ);

            echo"<b><label for='ville_depart'>Ville de départ</label></b><br>";
            echo"<select name ='ville_depart' id ='ville_depart' required>";
            echo"<option value = '' selected disabled>------------------------------Sélectionnez le départ------------------------------</option>";
            foreach ($results as $element) {
                printf("<option value='%s'>%s</option>",
                        $element->id,
                        ucfirst($element->nom));
            }
            echo"</select>";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        echo"</div>";
        echo"<br>";

//------------------------ARRIVEE-------------------------------
        echo"<div class='form-group mb-3'>";
        $requete = "SELECT ville.id, ville.nom "
                . "FROM ville ";
        try {
            $database = Model::getInstance();
            $results = $database->query($requete);
            $results->setFetchMode(PDO::FETCH_OBJ);

            echo"<b><label for='ville_arrivee'>Ville d'arrivee</label></b><br>";
            echo"<select name ='ville_arrivee' id ='ville_arrivee' required>";
            echo"<option value = '' selected disabled>------------------------------Sélectionnez l'arrivée------------------------------</option>";
            foreach ($results as $element) {
                printf("<option value='%s'>%s</option>",
                        $element->id,
                        ucfirst($element->nom));
            }
            echo"</select>";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        echo"</div>";
        echo"<br>";

//--------------------------VEHICULE---------------------------------
        echo"<div class='form-group mb-3'>";
        $requete = "SELECT vehicule.id, vehicule.marque, vehicule.modele, vehicule.immatriculation "
                . "FROM vehicule, utilisateur AS conducteur "
                . "WHERE conducteur.login = '{$_SESSION['login_id']}' "
                . "AND conducteur.id = vehicule.proprietaire_id";
        try {
            $database = Model::getInstance();
            $results = $database->query($requete);
            $results->setFetchMode(PDO::FETCH_OBJ);

            echo"<b><label for='vehicule_choisi'>Vehicule Choisi</label></b><br>";
            echo"<select name ='vehicule_choisi' id ='vehicule_choisi' required>";
            echo"<option value = '' selected disabled>------------------------------Sélectionnez le véhicule------------------------------</option>";
            foreach ($results as $element) {
                printf("<option value='%s'>%s %s (%s)</option>",
                        $element->id,
                        ucfirst($element->marque),
                        ucfirst($element->modele),
                        strtoupper($element->immatriculation));
            }
            echo"</select>";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        echo"</div>";
        echo"<br>";

        //-----------------PRIX---------------------
        ?>
        <div class="form-group mb-3">
            <div class="premium-input-group">
                <div class="premium-input-wrapper">
                    <b><label for="prix_trajet">Prix du trajet</label></b><br>
                    <input type="number" id="prix_trajet" name="prix" class="premium-input" 
                           min="0" max="200" step="0.1" placeholder="Ex: 14.50" required>
                    <span class="premium-currency">€</span>
                </div>
            </div>
        </div>

        <?php
        //----------DATE-------------------- 
        $aujourdhui = date('Y-m-d');
        ?>

        <div class="form-group mb-3">
            <b><label for="date_depart">Date départ</label></b><br>
            <input type="date" id="date_depart" name="date_depart" 
                   class="form-control" min="<?php echo $aujourdhui; ?>" required>
        </div>


        <?php
        //-----------HEURE-----------------
        $heure_actuelle = date('H:i')
        ?>

        <div class="form-group mb-3">
            <b><label for="heure_depart">Heure de départ</label></b><br>
            <input type="time" id="heure_depart" name="heure_depart" 
                   class="form-control" required>
        </div>
        <br>
        
        
        <button class = "btn btn-primary" type = "submit">Ajouter le trajet</button>
        <button class = "btn btn-danger" type = "reset">Reset les informations</button>
        <br><br>
    </div>

</div>
<p/>
<br/>

</form>
<p/>
</div>
<?php include $root . '/app/view/fragment/fragmentFooter.html';
?>

<!-- ----- fin viewConducteurTrajetAjout ---- -->



