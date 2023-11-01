<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un projet</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

    <a href="javascript:history.back()" class="btn bouton-retour">
            <i class="fas fa-arrow-left fleche-retour"></i> Retour
        </a>

        <h2>Ajouter un projet</h2>

        <?php
        // Connexion à la base de données
        $host = "localhost";
        $dbname = "portfolio";
        $username = "root";
        $password = "";

        try {
            $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Récupération des catégories
            $requete_categories = $bdd->prepare("SELECT * FROM categories");
            $requete_categories->execute();
            $categories = $requete_categories->fetchAll();

        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
        ?>

        <form action="insert_project.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" id="titre" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <select name="categorie" id="categorie" class="form-control">
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?php echo $categorie['name']; ?>"><?php echo $categorie['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            
            <input type="submit" value="Ajouter" class="btn btn-primary">
        </form>
    </div>
</body>
</html>
