# Neuilly BS — Site vitrine et réservation d'espaces

Site PHP simple présentant des offres d'espaces de travail (bureaux partagés/privés et salles de réunion) avec pages publiques, authentification basique (inscription/connexion) et styles modernes responsive.

## Fonctionnalités

- Pages: Accueil, Offres, Détail d’offre (avec slider), Contact
- Authentification basique (inscription/connexion) via MySQL
- Réservation d’espace (page `reserve.php`) avec insertion en BDD
- Formulaire de contact avec stockage des messages
- UI modernisée: navigation responsive, hero, cartes d’offres, thème propre
- Balises SEO/OG, favicon, logo SVG

## Stack

- PHP 7+/8+, MySQL/MariaDB
- HTML/CSS, Google Fonts, Font Awesome (CDN)
- jQuery + Slick Carousel (CDN)

## Démarrage rapide (WAMP/XAMPP)

1. Placez le dossier du projet dans votre `www`/`htdocs` (ici `NeuillyBS`).
2. Créez la base et les tables:
   - Importez `database/schema.sql` dans votre MySQL.
3. Configurez l’accès BDD dans `includes/db.php` si besoin.
4. Ouvrez `http://localhost/NeuillyBS/index.php`.

## Schéma MySQL minimal

```sql
CREATE DATABASE IF NOT EXISTS neuilly_bs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE neuilly_bs;

CREATE TABLE IF NOT EXISTS clients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  telephone VARCHAR(30) NOT NULL,
  email VARCHAR(150) NOT NULL,
  identifiant VARCHAR(100) NOT NULL UNIQUE,
  mot_de_passe VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Réservations d'espaces
CREATE TABLE IF NOT EXISTS reservations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  client_identifiant VARCHAR(100) NOT NULL,
  offer_type ENUM('shared','private','meeting') NOT NULL,
  date_resa DATE NOT NULL,
  duree_heures INT NOT NULL DEFAULT 1,
  notes TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (client_identifiant),
  CONSTRAINT fk_resa_client_ident FOREIGN KEY (client_identifiant)
    REFERENCES clients(identifiant) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Messages du formulaire de contact
CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  contenu TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Notes portfolio

- Textes en français corrigés (accents, typographie)
- En-tête responsive (burger menu), logo et favicon SVG
- Footer avec année dynamique
- Détails d’offre: guard côté serveur si `type` invalide, CTA de réservation
- Réservation: formulaire connecté, validation, insertion en base
- Contact: formulaire avec enregistrement des messages
- Aucune dépendance locale à installer (CDN)

## Améliorations possibles

- Espace client (liste/annulation des réservations)
- Envoi d’e-mails (PHPMailer) + notifications admin
- Tests E2E (Playwright) et CI

