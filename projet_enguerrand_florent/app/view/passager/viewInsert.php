
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
        <input type="hidden" name='action' value='PassagerCreated'>        
        <label class='w-25' for="id">nom : </label><input type="text" name='nom' size='75' value='Claire'> <br/> 
        <label class='w-25' for="id">prenom : </label><input type="text" name='prenom' size='75' value='Orange'>        <br/>
        <label class='w-25' for="id">solde : </label><input type="number" step='any' name='solde' value='1500'>        <br/>          
      </div>
      <p/>
       <br/> 
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

<!-- ----- fin viewInsert -->



