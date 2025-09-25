<?php
// Démarre la session si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirige si déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit();
}

include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = $_POST['identifiant'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    $sql = "SELECT * FROM clients WHERE identifiant = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $identifiant);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();
        if (password_verify($mot_de_passe, $client['mot_de_passe'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['identifiant'] = $client['identifiant'];
            header('Location: index.php');
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Identifiant incorrect.";
    }
    $stmt->close();
    $conn->close();
}
?>
<?php include('includes/header.php'); ?>
<main>
    <section class="login">
        <h2 class="section-title">Connexion</h2>
        <?php if (isset($error)): ?>
            <p style="color:#b91c1c; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <input type="text" name="identifiant" placeholder="Identifiant" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit" class="btn">Se connecter</button>
        </form>
        <p style="text-align:center; color:#6b7280;">Pas encore inscrit ? <a href="register.php">Inscrivez-vous ici</a></p>
    </section>
</main>
<?php include('includes/footer.php'); ?>

