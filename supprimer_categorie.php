<!DOCTYPE html>
<html>
<head>
    <title>Supprimer une catégorie</title>
</head>
<body>

    <?php
    $host = "localhost";
    $dbname = "portfolio";
    $username = "root";
    $password = "";

    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Supprimer la catégorie de la base de données
            $requete = $bdd->prepare("DELETE FROM categories WHERE id = :id");
            $requete->bindParam(':id', $id);
            $requete->execute();

            // Informer l'utilisateur et rediriger vers la page liste_categories.php
            echo "La catégorie a été supprimée avec succès. Vous serez redirigé vers la liste des catégories dans 5 secondes.";
            header("Refresh: 5; URL=liste_categories.php");

        } else {
            echo "Aucune catégorie sélectionnée.";
        }

    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    ?>

</body>
</html>
