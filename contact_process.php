<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "portfolio";
$username = "root";
$password = "";

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les données ont été soumises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Insérer les données dans la table contact
        $requete_insert = $bdd->prepare("INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)");
        $requete_insert->bindParam(':name', $name);
        $requete_insert->bindParam(':email', $email);
        $requete_insert->bindParam(':message', $message);
        $requete_insert->execute();

        // Rediriger vers la page de confirmation ou la page d'accueil après l'envoi du message
        header("Location: success_page.php");
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
    