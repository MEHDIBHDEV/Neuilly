<?php
$contact_success = null;
$contact_error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'includes/db.php';
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contenu = trim($_POST['message'] ?? '');
    if (!$nom || !$email || !$contenu) {
        $contact_error = "Tous les champs sont requis.";
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (nom, email, contenu) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $nom, $email, $contenu);
        if ($stmt->execute()) {
            $contact_success = "Merci pour votre message. Nous revenons vers vous rapidement.";
        } else {
            $contact_error = "Impossible d'enregistrer votre message pour le moment.";
        }
        $stmt->close();
    }
}
?>
<?php include('includes/header.php'); ?>
<main>
    <section class="contact">
        <h2 class="section-title">Contactez-nous</h2>
        <div class="contact-info">
            <p>Adresse : 79 Rue des Frères Lumière, Neuilly-sur-Marne, 93330, France</p>
            <p>Email : email@example.com</p>
            <p>Téléphone : +33 1 23 45 67 89</p>
        </div>
        <?php if ($contact_success): ?>
            <p class="alert success"><?php echo htmlspecialchars($contact_success); ?></p>
        <?php elseif ($contact_error): ?>
            <p class="alert error"><?php echo htmlspecialchars($contact_error); ?></p>
        <?php endif; ?>
        <form method="post" action="contact.php">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Votre email" required>
            <textarea name="message" class="textarea" rows="4" placeholder="Votre message" required></textarea>
            <button type="submit" class="btn">Envoyer</button>
        </form>
        <div id="map" style="margin-top:16px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.5262867770725!2d2.5182197118868164!3d48.86724297121379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6126c1211177b%3A0xd93cd5f50f8f4e4e!2s79%20Rue%20des%20Fr%C3%A8res%20Lumi%C3%A8re%2C%2093330%20Neuilly-sur-Marne!5e0!3m2!1sen!2sfr!4v1718198727491!5m2!1sen!2sfr" width="600" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</main>
<?php include('includes/footer.php'); ?>
