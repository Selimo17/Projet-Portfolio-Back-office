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

    // Mise à jour du profil
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $presentation = $_POST['presentation'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = 'assets/imgs/' . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        } else {
            $image = $profil['image'];
        }

        $requete_update = $bdd->prepare("UPDATE profil SET presentation = :presentation, image = :image WHERE id = 1");
        $requete_update->bindParam(':presentation', $presentation);
        $requete_update->bindParam(':image', $image);
        $requete_update->execute();

        echo "<div class='alert alert-success'>Le profil a été mis à jour avec succès. Vous serez redirigé vers la liste des projets dans 5 secondes.</div>";
        header("Refresh: 5; URL=liste_projets.php");
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer le profil</title>
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

        <h1>Gérer le profil</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="presentation">Présentation :</label>
                <textarea name="presentation" id="presentation" class="form-control" required><?php echo $profil['presentation']; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
