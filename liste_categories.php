<!DOCTYPE html>
<html>
<head>
    <title>Liste des catégories</title>
    <!-- Inclure les liens vers Bootstrap pour la présentation -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <!-- Inclure le lien vers jQuery et Bootstrap JavaScript pour les fonctionnalités -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Personnaliser les styles CSS selon vos préférences */
        .navbar {
            margin-bottom: 0;
        }
        #categories {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Back-office Portfolio</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="liste_projets.php" id="btn-liste-projets">Liste des projets</a></li>
                <li><a href="add_project.php" id="btn-ajouter-projet">Ajouter un projet</a></li>
                <li class="active"><a href="#" id="btn-liste-categories">Liste des catégories</a></li>
                <li><a href="ajouter_categorie.php" id="btn-ajouter-categorie">Ajouter une catégorie</a></li>
                <li><a href="manage_profil.php" id="btn-profil">Profil</a></li>
            <li><a href="admin_contact.php" id="btn-view-contact">Contact</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <form action="logout.php" method="post" class="navbar-form">
                    <input type="submit" value="Déconnexion" class="btn btn-default">
                </form>
            </li>
        </ul>
        </div>
    </nav>
    <?php
    // ici commence le code d'affichage

    $host = "localhost"; // Le serveur où est hébergée la base de données
    $dbname = "portfolio"; // Le nom de la base de données
    $username = "root"; // Le nom d'utilisateur de la base de données
    $password = ""; // Le mot de passe de la base de données

    // Connexion à la base de données avec PDO
    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        // Configuration de PDO pour afficher les erreurs SQL
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des catégories dans la table "categories"
        $requete = $bdd->prepare("SELECT * FROM categories");
        $requete->execute();
        $categories = $requete->fetchAll();

        // Affichage des catégories sous forme de tableau
        echo '<div class="container">';
        echo '<div id="categories">';
        echo '<h2>Liste des catégories</h2>';
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Nom de la catégorie</th><th>Image</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        foreach ($categories as $categorie) {
            echo '<tr>';
            echo '<td>' . $categorie['name'] . '</td>';
            echo '<td><img src="' . $categorie['image'] . '" alt="' . $categorie['name'] . '" width="100" height="100"></td>';
            echo '<td><a href="modifier_categorie.php?id=' . $categorie['id'] . '">Modifier</a> | <a href="supprimer_categorie.php?id=' . $categorie['id'] . '" onclick="return confirm(\'Voulez-vous vraiment supprimer cette catégorie ?\')">Supprimer</a></td>';
            echo '</tr>';
        }

        echo '</tbody></table></div></div>';

    } catch (PDOException $e) {
        // Affichage de l'erreur en cas de problème de connexion
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }

    // ici se termine le code d'affichage
    ?>
</body>
</html>
