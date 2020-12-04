<?php
session_start();
include_once ('connexiondb.php');

if (isset($_POST['Connexion']))
{
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    if (!empty($login) and !empty($password))
    {
        $reqlogin = $BDD->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password =?");
        $reqlogin->execute(array(
            $login,
            $password
        ));
        $loginexist = $reqlogin->rowCount();
        if ($loginexist == 1)
        {
            $logininfo = $reqlogin->fetch();
            $_SESSION['id'] = $logininfo['id'];
            $_SESSION['login'] = $logininfo['login'];
            $_SESSION['nom'] = $logininfo['nom'];
            $_SESSION['prenom'] = $logininfo['prenom'];
            header("location:index.php?id=" . $_SESSION['id']);

        }
        else
        {
            $erreur = "Login ou mot de passe incorrect !";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }
}

?>
<html lang=fr>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Accueil</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>
<h2>Connexion à votre profil</h2>
<?php if (isset($erreur))
{
    echo '<font color="red">' . $erreur . '</font>';
}
?>
<form action="connexion.php" method="post">
    <section>
        <label for="Login">Login</label>
        <input type="text" id="Login" name="login"/>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password"/>
        <label for="Envoyer"></label>
        <input type="submit" name="Connexion" value="Connexion"/></br>
    </section>
</form>
<section>
<a class="button" href="inscription.php">S'inscrire !</a>
</section>
</body>
</html>
