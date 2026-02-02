<?php ?>
<nav class="navbar avbar-expand-lg navbar-light bg-white border-bottom position-relative">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="../index.php">
            <img src="../assets/logo.webp" alt="Logo" height="40" width="131" class="me-2" loading="lazy"> 
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="button">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav navbar-nav-centered">
                <li class="nav-item"><a class="nav-link fw-semibold" href="mots.php">Jeux</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="leaderboard.php">Leaderboard</a></li>
            </ul>

            <div class="d-flex ms-auto nav-auth">
                <?php if (isset($_SESSION["id"])): ?>
                    <a class="btn btn-outline-dark me-2" href="admin.php">Admin</a>
                    <a class="btn btn-outline-dark me-2" href="profil.php">Mon Profil</a>
                    <a class="btn btn-dark" href="deconexion.php">Déconnexion</a>
                <?php else: ?>
                    <a class="btn btn-outline-dark me-2" href="account.php?mode=login">Connexion</a>
                    <a class="btn btn-dark" href="account.php?mode=register">S'inscrire</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>