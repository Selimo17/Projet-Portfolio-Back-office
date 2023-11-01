<!-- portfolio section -->
<section class="section" id="portfolio">
        <div class="container text-center">
            <p class="section-subtitle">What I Did ?</p>
            <h6 class="section-title mb-6">Portfolio</h6>

            <div class="row">
                <?php
                $host = "localhost";
                $dbname = "portfolio";
                $username = "root";
                $password = "";

                try {
                    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $requete = $bdd->prepare("SELECT * FROM categories");
                    $requete->execute();
                    $categories = $requete->fetchAll();

                    foreach ($categories as $categorie) {
                        echo '<div class="col-md-4">';
                        echo '<a class="portfolio-card" href="projets_par_categorie.php?id=' . $categorie['id'] . '">';
                        echo '<img src="' . $categorie['image'] . '" class="portfolio-card-img" alt="' . $categorie['name'] . '">';
                        echo '<span class="portfolio-card-overlay">';
                        echo '<span class="portfolio-card-caption">';
                        echo '<h4>' . $categorie['name'] . '</h4>';
                        echo '<p class="font-weight-normal">Salim Oueslati</p>';
                        echo '</span>';
                        echo '</span>';
                        echo '</a>';
                        echo '</div>';
                    }

                } catch (PDOException $e) {
                    echo "Erreur de connexion à la base de données : " . $e->getMessage();
                }
                ?>
            </div><!-- end of row -->
        </div><!-- end of container -->
    </section> <!-- end of portfolio section -->