<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "portfolio";
$username = "root";
$password = "";

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération du profil
    $requete_profil = $bdd->prepare("SELECT * FROM profil WHERE id = 1");
    $requete_profil->execute();
    $profil = $requete_profil->fetch();
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos</title>
    <!-- Ajoutez vos liens CSS ici -->
</head>
<body>
    <!-- about section -->
    <section class="section pt-0" id="about">
        <!-- container -->
        <div class="container text-center">
            <!-- about wrapper -->
            <div class="about">
                <div class="about-img-holder">
                    <img src="<?php echo $profil['image']; ?>" class="about-img" alt="Image du profil">
                </div>
                <div class="about-caption">
                    <p class="section-subtitle">Qui suis-je ?</p>
                    <h2 class="section-title mb-3">À propos de moi</h2>
                    <p>
                        <?php echo nl2br($profil['presentation']); ?>
                    </p>
                    <a href="assets/doc/CV_Salim.pdf" download>
                        <button class="btn-rounded btn btn-outline-primary mt-4">Télécharger le CV</button>
                    </a>
                </div>
            </div><!-- end of about wrapper -->
        </div><!-- end of container -->
    </section> <!-- end of about section -->
    <!-- Ajoutez vos scripts JS ici -->
</body>
</html>
