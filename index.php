<?php
session_start();
include_once ('connexiondb.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet"> 
</head>
<body>
    <header>
         <a href="deconnexion.php">Se déconnecter</a>
         <a href="profil.php">Editer profil</a>
         <a href="admin.php">Espace admin</a>
    </header>
<main>
<?php
echo 'Bienvenu : ' . $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
?>
</main>
<footer>
    <ul>
        <li>Connexion forever</li>
    </ul>
</footer>  
</body>
</html>
