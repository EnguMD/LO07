<?php
session_start();
$_SESSION['login_id'] = -1;
header('Location: app/router/router1.php?action=Profitez-bien-du-covoiturage-:)');
?>  