<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Accès réservé aux utilisateurs connectés
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

$success = null;
$error = null;

$offer_type = $_GET['type'] ?? ($_POST['offer_type'] ?? '');
if (!in_array($offer_type, ['shared','private','meeting'])) {
    $offer_type = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_identifiant = $_SESSION['identifiant'] ?? '';
    $offer_type = $_POST['offer_type'] ?? '';
    $date_resa = $_POST['date_resa'] ?? '';
    $duree_heures = (int)($_POST['duree_heures'] ?? 1);
    $notes = $_POST['notes'] ?? null;

    if (!in_array($offer_type, ['shared','private','meeting'])) {
        $error = "Type d'offre invalide.";
    } elseif (!$date_resa) {
        $error = "Veuillez choisir une date.";
    } elseif ($duree_heures < 1 || $duree_heures > 12) {
        $error = "La durée doit être comprise entre 1 et 12 heures.";
    } else {
        $sql = "INSERT INTO reservations (client_identifiant, offer_type, date_resa, duree_heures, notes) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssis', $client_identifiant, $offer_type, $date_resa, $duree_heures, $notes);
        if ($stmt->execute()) {
            $success = "Réservation enregistrée. Nous vous recontacterons pour confirmation.";
        } else {
            $error = "Erreur lors de l'enregistrement: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}
?>
<?php include 'includes/header.php'; ?>
<main>
    <section class="register">
        <h2 class="section-title">Réserver un espace</h2>
        <?php if ($success): ?>
            <p class="alert success"><?php echo htmlspecialchars($success); ?></p>
        <?php elseif ($error): ?>
            <p class="alert error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="reserve.php" method="post">
            <label>
                Type d'offre
                <select name="offer_type" required>
                    <option value="" disabled <?php echo $offer_type ? '' : 'selected'; ?>>Choisir un type</option>
                    <option value="shared" <?php echo $offer_type==='shared'?'selected':''; ?>>Bureau partagé</option>
                    <option value="private" <?php echo $offer_type==='private'?'selected':''; ?>>Bureau privé</option>
                    <option value="meeting" <?php echo $offer_type==='meeting'?'selected':''; ?>>Salle de réunion</option>
                </select>
            </label>
            <label>
                Date
                <input type="date" name="date_resa" required>
            </label>
            <label>
                Durée (heures)
                <input type="number" name="duree_heures" min="1" max="12" value="2" required>
            </label>
            <label>
                Notes (optionnel)
                <textarea name="notes" class="textarea" rows="3" placeholder="Précisions, besoins, horaires..."></textarea>
            </label>
            <button type="submit" class="btn">Envoyer la demande</button>
        </form>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
