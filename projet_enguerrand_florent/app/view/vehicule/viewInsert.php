
<!-- ----- début viewInsert -->

<?php
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.php';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?> 

        <form role="form" method='get' action='router1.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='VehiculeCreated'>        
                <label class='w-25' for="id">Marque : </label><input type="text" name='marque' size='75' value='Porsche'> <br/> 
                <label class='w-25' for="id">Modèle : </label><input type="text" name='modele' size='75' value='911'>        <br/>
                <label class='w-25' for="id">Année : </label><input type="number" step='any' name='annee' value='2010'>        <br/>          
                <label class='w-25' for="id">Immatriculation : </label><input type="text" name='immatriculation' size='75' value='gm-552-rt'>        <br/>
                <label for="id">Propriétaire : </label> <select class="form-control" id='proprietaire' name='proprietaire' style="width: 300px"><br/>
                    <?php
                    foreach ($results as $id) {
                        echo ("<option>$id</option>");
                    }
                    ?>
                </select>
            </div>
            <p/>
            <br/> 
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        <p/>
    </div>
    <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

    <!-- ----- fin viewInsert -->



