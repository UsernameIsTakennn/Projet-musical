<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau genre</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">
            <form action="genre-store.php" method="post">
                <h2>Nouveau genre</h2>

                <label>Nom
                    <input type="text" name="nom" required>
                </label>

                <input type="submit"  value="Enregistrer">
            </form>
        </div>
    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>