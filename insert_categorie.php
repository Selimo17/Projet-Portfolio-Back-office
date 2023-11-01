<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "portfolio";
$username = "root";
$password = "";

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des données du formulaire
    $name = $_POST['name'];

    // Gestion du téléchargement de l'image
    $image = $_FILES['image'];
    $target_dir = "assets/imgs";
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérification de l'extension de l'image
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        exit;
    }

    // Déplacement de l'image téléchargée vers le dossier de destination
    if (!move_uploaded_file($image["tmp_name"], $target_file)) {
        echo "Erreur lors du téléchargement de l'image.";
        exit;
    }

    // Insertion de la catégorie dans la base de données
    $requete = $bdd->prepare("INSERT INTO categories (name, image) VALUES (:name, :image)");
    $requete->bindParam(':name', $name);
    $requete->bindParam(':image', $target_file);
    $requete->execute();

    // Redirection vers la page d'accueil (ou une autre page) après l'insertion
    header("Location: liste_categories.php");

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
