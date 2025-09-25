<?php
// Démarrer la session au besoin
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('includes/header.php');

$type = isset($_GET['type']) ? $_GET['type'] : '';

$offer_details = [
    'shared' => [
        'title' => 'Bureau partagé',
        'desc'  => "À Neuilly Bureaux Services, nos espaces de travail s’adaptent à tous vos besoins professionnels. Une option idéale pour indépendants et startups à horaires flexibles, à prix abordable. Haut débit, impression et plus encore inclus.",
        'price' => '100€ / jour',
        'images' => [
            ['src' => 'images/bureauP1.avif', 'alt' => 'Bureau partagé 1'],
            ['src' => 'images/bureaiP2.webp', 'alt' => 'Bureau partagé 2'],
        ],
    ],
    'private' => [
        'title' => 'Bureau privé',
        'desc'  => "Des espaces de travail privés, sécurisés et confortables, parfaits si vous recherchez régularité et qualité. Profitez d’un cadre professionnel avec tous les avantages de notre communauté.",
        'price' => '200€ / jour',
        'images' => [
            ['src' => 'images/bureauPriv1.jpg', 'alt' => 'Bureau privé 1'],
            ['src' => 'images/bureauPriv2.jpg', 'alt' => 'Bureau privé 2'],
        ],
    ],
    'meeting' => [
        'title' => 'Salle de réunion',
        'desc'  => "L’entrepreneuriat est dans l’air chez Neuilly Bureaux Services. Nos salles de réunion vous permettent d’en profiter pleinement, avec prestations complètes et équipements inclus.",
        'price' => '300€ / jour',
        'images' => [
            ['src' => 'images/salledeReunion1.jpg', 'alt' => 'Salle de réunion 1'],
            ['src' => 'images/salledereunion2.jpg', 'alt' => 'Salle de réunion 2'],
        ],
    ],
];

$details = $offer_details[$type] ?? null;
?>

<main>
    <section class="offer-detail">
        <?php if (!$details): ?>
            <h2>Offre introuvable</h2>
            <p>Cette offre n’existe pas ou a été déplacée.</p>
            <p><a class="btn" href="offres.php">Voir toutes nos offres</a></p>
        <?php else: ?>
            <h2><?php echo htmlspecialchars($details['title']); ?></h2>
            <div class="slider">
                <?php foreach ($details['images'] as $img): ?>
                    <div><img src="<?php echo $img['src']; ?>" alt="<?php echo htmlspecialchars($img['alt']); ?>" class="offer-image"></div>
                <?php endforeach; ?>
            </div>
            <div class="offer-description">
                <p><?php echo htmlspecialchars($details['desc']); ?></p>
                <p><strong>Prix&nbsp;: <?php echo htmlspecialchars($details['price']); ?></strong></p>
            </div>
            <p>
                <a href="reserve.php?type=<?php echo urlencode($type); ?>" class="btn">Réserver maintenant</a>
            </p>
            <p style="margin-top:8px; color:#6b7280">
                Besoin d’informations ? <a href="contact.php">Contactez-nous</a>
            </p>
        <?php endif; ?>
    </section>
    
</main>
<?php include('includes/footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
$(document).ready(function(){
    $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
    });
});
</script>
