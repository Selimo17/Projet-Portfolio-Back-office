<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une catégorie</title>
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
        <h2>Ajouter une catégorie</h2>

        <form action="insert_categorie.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nom de la catégorie:</label>
                <input type="text" name="name" id="name" class="form-control" required>
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
