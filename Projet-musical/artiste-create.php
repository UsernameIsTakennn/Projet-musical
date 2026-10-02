<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel artiste</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <div class="container">

            <form action="artiste-store.php" method="post">

                <h2>Nouvel artiste</h2>

                <label>Nom
                    <input type="text" name="nom" required>
                </label>

                <label>Pays
                    <input type="text" name="pays">
                </label>

                <label>Date de naissance
                    <input type="date" name="date_naissance">
                </label>

                <label>Biographie
                    <input type="text" name="biographie">
                </label>

                <input type="submit"  value="Enregistrer">

            </form>

        </div>
    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>