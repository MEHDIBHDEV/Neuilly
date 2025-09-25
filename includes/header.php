<?php
// Vérifie si une session n'est pas déjà démarrée avant de démarrer une nouvelle session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neuilly BS — Espaces de travail modernes à Neuilly-sur-Marne</title>
    <meta name="description" content="Neuilly BS propose des bureaux partagés, privés et des salles de réunion modernes à Neuilly-sur-Marne. Réservez un espace adapté à vos besoins.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="/index.php">
    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Neuilly BS — Espaces de travail modernes">
    <meta property="og:description" content="Bureaux partagés, privés et salles de réunion. Flexibles et adaptés à vos besoins.">
    <meta property="og:image" content="/images/background.jpg">
    <meta property="og:url" content="/index.php">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="/images/favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
</head>
<body>
    <header class="site-header">
        <nav class="site-nav" aria-label="Navigation principale">
            <a class="brand" href="index.php" aria-label="Retour à l'accueil">
                <img src="images/logo.svg" alt="Logo Neuilly BS" width="36" height="36">
                <span>Neuilly BS</span>
            </a>

            <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-label="Ouvrir le menu">
            <label for="nav-toggle" class="nav-toggle-btn" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <?php $current = basename($_SERVER['PHP_SELF']); ?>
            <ul class="nav-links">
                <li><a href="index.php" <?php echo $current==='index.php'?'aria-current="page" class="active"':''; ?>>Accueil</a></li>
                <li><a href="offres.php" <?php echo $current==='offres.php'?'aria-current="page" class="active"':''; ?>>Offres</a></li>
                <li><a href="contact.php" <?php echo $current==='contact.php'?'aria-current="page" class="active"':''; ?>>Contact</a></li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Se déconnecter</a></li>
                <?php else: ?>
                    <li><a href="login.php" <?php echo $current==='login.php'?'aria-current="page" class="active"':''; ?>><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Se connecter</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
