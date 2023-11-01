<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Meyawo landing page.">
    <meta name="author" content="Devcrud">
    <title>Formulaire de connexion</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Meyawo main styles -->
	<link rel="stylesheet" href="assets/css/meyawo.css">
    <!-- Inclure le lien vers Bootstrap pour la présentation -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>


<!-- page header -->
<header id="home" class="header">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h2>Connexion</h2>
                <form action="liste_projets.php" method="POST">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
                <p style="color:red;">
                <?php
session_start();

    $dsn = 'mysql:host=localhost;dbname=portfolio';
    $username = 'root';
    $password = '';

    try {
        $connexion = new PDO($dsn, $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérification des données de connexion de l'utilisateur
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $requete = "SELECT * FROM users WHERE username = :username AND password = :password";
            $stmt = $connexion->prepare($requete);
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->bindParam(':password', $_POST['password']);
            $stmt->execute();
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

            if($resultat) {
                // Si les informations de connexion sont correctes, redirigez l'utilisateur vers le back-office
                header('Location: back-office.php');
                exit;
            } else {
                // Si les informations de connexion sont incorrectes, affichez un message d'erreur
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }


?>
</p>
            </div>
        </div>
    </div>



    
                    
    </header><!-- end of page header -->
</body>
</html>
