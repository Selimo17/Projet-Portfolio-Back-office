<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "portfolio";
$username = "root";
$password = "";

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération de l'ID du projet
    $id = $_GET['id'];

    // Suppression du projet dans la base de données
    $requete = $bdd->prepare("DELETE FROM projets WHERE id = :id");
    $requete->bindParam(':id', $id);
    $requete->execute();

    // Redirection vers la page d'accueil (ou une autre page) après la suppression
    header("Location: liste_projets.php");

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
