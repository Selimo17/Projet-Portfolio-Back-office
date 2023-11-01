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
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $categorie = $_POST['categorie'];
    $description = $_POST['description'];

    // Gestion du téléchargement de l'image
    $image = $_FILES['image'];
    $target_dir = "assets/imgs";
    $target_file = $target_dir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérification de l'extension de l'image
    if (!empty($image["name"]) && !in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        exit;
    }

    // Déplacement de l'image téléchargée vers le dossier de destination
    if (!empty($image["name"]) && !move_uploaded_file($image["tmp_name"], $target_file)) {
        echo "Erreur lors du téléchargement de l'image.";
        exit;
    }

    // Mise à jour du projet dans la base de données
    if (!empty($image["name"])) {
        $requete = $bdd->prepare("UPDATE projets SET titre=:titre, categorie=:categorie, description=:description, image=:image WHERE id=:id");
        $requete->bindParam(':image', $target_file);
    } else {
        $requete = $bdd->prepare("UPDATE projets SET titre=:titre, categorie=:categorie, description=:description WHERE id=:id");
    }

    $requete->bindParam(':id', $id);
    $requete->bindParam(':titre', $titre);
    $requete->bindParam(':categorie', $categorie);
    $requete->bindParam(':description', $description);
    $requete->execute();

    // Redirection vers la page d'accueil (ou une autre page) après la mise à jour
    header("Location: liste_projets.php");

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
