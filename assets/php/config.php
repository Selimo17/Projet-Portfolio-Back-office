<?php

// Informations de connexion à la base de données
$host = 'localhost'; // Serveur
$dbname = 'portfolio'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur
$password = ''; // Mot de passe

// Connexion à la base de données en utilisant PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Activation des exceptions PDO pour les erreurs de requête
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, affichage d'un message d'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die(); // Arrêt du script
}

?>
