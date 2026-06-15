<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- ----- début fragmentMenu -->

<nav class="navbar navbar-expand-lg bg-success fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="router1.php?action=covoiturageAccueil">MARTINAUD et LASCOURS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <?php
                if ($_SESSION['login_id'] !== -1):
                    echo("<a class='navbar-brand'>| " . $_SESSION['login_id'] . " | " . $_SESSION['solde'] ."€". " | </a>");
                    ?>
                    <?php if ($_SESSION['role'] === 'administrateur'): ?>
                        <li class = "nav-item dropdown">
                            <a class = "nav-link dropdown-toggle" role = "button" data-bs-toggle = "dropdown" aria-expanded = "false">Administrateur</a>
                            <ul class = "dropdown-menu">
                                <li><a class = "dropdown-item" href = "router1.php?action=utilisateurReadAll">Liste des utilisateurs</a></li>
                                <li><a class = "dropdown-item" href = "router1.php?action=utilisateurAddConducteur">Ajout d'un conducteur</a></li>
                                <li><a class = "dropdown-item" href = "router1.php?action=utilisateurAddPassager">Ajout d'un passager</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class = "dropdown-item" href = "router1.php?action=vehiculeReadAll">Liste des véhicules</a></li>
                                <li><a class = "dropdown-item" href = "router1.php?action=VehiculeAdd">Ajout d'un véhicule</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class = "dropdown-item" href="router1.php?action=villeReadAll">Liste des villes</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['role'] === 'conducteur'): ?>
                        <li class = "nav-item dropdown">
                            <a class = "nav-link dropdown-toggle" role = "button" data-bs-toggle = "dropdown" aria-expanded = "false">Conducteur</a>
                            <ul class = "dropdown-menu">
                                <li><a class = "dropdown-item" href = "router1.php?action=conducteurVehiculeListe">Liste de mes véhicules</a></li>
                                <li><a class = "dropdown-item" href = "router1.php?action=conducteurTrajetListe">Liste de mes trajets</a></li>
                                <li><a class="dropdown-item" href="router1.php?action=conducteurTrajetAjout">Ajout d'un trajet</a></li>
                                <li><a class="dropdown-item" href="router1.php?action=conducteurTrajetListePassager">Liste des passagers pour un trajet</a></li>
                                <li><a class="dropdown-item" href="router1.php?action=conducteurTrajetFermer">Clôturer un trajet</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['role'] === 'passager'): ?>
                        <li class = "nav-item dropdown">
                            <a class = "nav-link dropdown-toggle" role = "button" data-bs-toggle = "dropdown" aria-expanded = "false">Passager</a>
                            <ul class = "dropdown-menu">
                                <li><a class = "dropdown-item" href = "router1.php?action=passagerListe">Liste de mes réservations</a></li>
                                <li><a class = "dropdown-item" href = "router1.php?action=passagerReservation">Réservation d’un trajet actif</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Examinateur</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router1.php?action=superglobales">Superglobales</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Se connecter</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router1.php?action=SeConnecterLogin">Login</a></li>
                        <li><a class="dropdown-item" href="router1.php?action=SeConnecterDeconnexion">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> 

<!-- ----- fin fragmentMenu -->

