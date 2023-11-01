<!DOCTYPE html>
<html>
<head>
    <title>Modifier une catégorie</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modifier une catégorie</h2>

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

                // Récupérer les informations de la catégorie
                $requete = $bdd->prepare("SELECT * FROM categories WHERE id = :id");
                $requete->bindParam(':id', $id);
                $requete->execute();
                $categorie = $requete->fetch();

                if (!$categorie) {
                    echo "La catégorie n'existe pas.";
                } else {
                    // Traiter le formulaire de modification si soumis
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = $_POST['name'];

                        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                            $image = 'assets/imgs' . basename($_FILES['image']['name']);
                            move_uploaded_file($_FILES['image']['tmp_name'], $image);
                        } else {
                            $image = $categorie['image'];
                        }

                        // Mettre à jour la catégorie dans la base de données
                        $requete = $bdd->prepare("UPDATE categories SET name = :name, image = :image WHERE id = :id");
                        $requete->bindParam(':name', $name);
                        $requete->bindParam(':image', $image);
                        $requete->bindParam(':id', $id);
                        $requete->execute();

                        echo "<div class='alert alert-success'>La catégorie a été modifiée avec succès. Vous serez redirigé vers la liste des catégories dans 5 secondes.";
                        header("Refresh: 5; URL=liste_categories.php");
                        
                    }

                    // Afficher le formulaire de modification de catégorie
                    echo '<form method="post" enctype="multipart/form-data">';
                    echo '<div class="form-group">';
                    echo '<label for="name">Nom de la catégorie :</label>';
                    echo '<input type="text" class="form-control" id="name" name="name" value="' . $categorie['name'] . '">';
                    echo '</div>';
                    echo '<div class="form-group">';
                    echo '<label for="image">Image :</label>';
                    echo '<input type="file" class="form-control" id="image" name="image">';
                    echo '</div>';
                    echo '<button type="submit" class="btn btn-primary">Enregistrer les modifications</button>';
                    echo '</form>';
                }
            } else {
                echo "Aucune catégorie sélectionnée.";
            }

        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
        ?>

    </div>
</body>
</html>
