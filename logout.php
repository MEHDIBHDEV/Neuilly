<?php
// Vérifie si une session n'est pas déjà démarrée avant de démarrer une nouvelle session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Détruit toutes les variables de session
$_SESSION = array();

// Si un cookie de session existe, le supprimer également
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruit la session
session_destroy();

// Redirige l'utilisateur vers la page de connexion ou d'accueil
header("Location: login.php");
exit();
?>
