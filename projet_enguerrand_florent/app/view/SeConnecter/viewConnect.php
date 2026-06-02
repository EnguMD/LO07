
<!-- ----- début viewId -->
<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentMenu.html';
      include $root . '/app/view/fragment/fragmentJumbotron.html';

      // $results contient un tableau avec la liste des clés.
      ?>

    <form role="form" method='get' action='router1.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='SeConnecterConnect'>
        <label class='w-25' for="login">Login : </label><input type="text" name='login' size='75' value='trisprior'> <br/>                          
        <label class='w-25' for="password">Password : </label><input type="password" name='password' size='75' value='secret'> <br/>
        </select>
      </div>
      <p/><br/>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentFooter.html'; ?>

  <!-- ----- fin viewId -->