<?php
// Démarre la session si nécessaire
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $email = $_POST['email'] ?? '';
    $identifiant = $_POST['identifiant'] ?? '';
    $mot_de_passe = password_hash($_POST['mot_de_passe'] ?? '', PASSWORD_BCRYPT);

    $sql = "INSERT INTO clients (nom, prenom, telephone, email, identifiant, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nom, $prenom, $telephone, $email, $identifiant, $mot_de_passe);

    if ($stmt->execute() === TRUE) {
        echo "Inscription réussie. Vous pouvez maintenant vous <a href='login.php'>connecter</a>.";
    } else {
        echo "Erreur: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
    $conn->close();
}
?>
<?php include('includes/header.php'); ?>
<main>
    <section class="register">
        <h2 class="section-title">Inscription</h2>
        <form action="register.php" method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="identifiant" placeholder="Identifiant" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit" class="btn">S'inscrire</button>
        </form>
    </section>
</main>
<?php include('includes/footer.php'); ?>

