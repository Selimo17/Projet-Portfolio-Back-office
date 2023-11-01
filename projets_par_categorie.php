<!DOCTYPE html>
<html>
<head>
    <title>Projets par catégorie</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Meyawo main styles -->
    <link rel="stylesheet" href="assets/css/meyawo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    $host = "localhost";
    $dbname = "portfolio";
    $username = "root";
    $password = "";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete_categorie = $bdd->prepare("SELECT * FROM categories WHERE id = ?");
            $requete_categorie->execute([$id]);
            $categorie = $requete_categorie->fetch();

            $requete_projets = $bdd->prepare("SELECT * FROM projets WHERE categorie = ?");
            $requete_projets->execute([$categorie['name']]);
            $projets = $requete_projets->fetchAll();

        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    } else {
        echo "Aucune catégorie sélectionnée.";
        exit;
    }
    ?>

    <section class="section" id="projets_par_categorie">
        <div class="container text-center">
            <p class="section-subtitle">Projets dans la catégorie : <?php echo $categorie['name']; ?></p>
            <h6 class="section-title mb-6">Projets par catégorie</h6>

            <div class="row">
    <?php
    if (isset($projets) && !empty($projets)) {
        foreach ($projets as $projet) {
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card h-100">';
            echo '<img src="' . $projet['image'] . '" class="card-img-top" alt="' . $projet['titre'] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $projet['titre'] . '</h5>';
            echo '<p class="card-text">' . $projet['description'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-center">Aucun projet trouvé pour cette catégorie.</p>';
    }
    ?>
            </div><!-- end of row -->

        </div><!-- end of container -->
    </section> <!-- end of projets_par_categorie section -->

</body>
</html>
