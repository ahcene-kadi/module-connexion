<?php
include_once ('connexiondb.php');

if (isset($_POST['Inscription']))
{
    if (!empty($_POST['login']) and !empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['password']) and !empty($_POST['passwordconfirm']))
    {
        $login = htmlspecialchars($_POST['login']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['passwordconfirm']);

        $loginlength = strlen($login);
        if ($loginlength <= 30)
        {
            $reqlogin = $BDD->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $reqlogin->execute(array(
                $login
            ));
            $loginexist = $reqlogin->rowCount();
            if ($loginexist == 0)
            {

                if ($password == $password2)
                {
                    $insertmbr = $BDD->prepare("INSERT INTO utilisateurs(login, nom, prenom, password) VALUES (?,?,?,?)");
                    $insertmbr->execute(array(
                        $login,
                        $nom,
                        $prenom,
                        $password
                    ));
                    header('location: connexion.php');
                }
                else
                {
                    $erreur = "Vos mots de passes ne coresspondent pas !";
                }
            }
            else
            {
                $erreur = "Login déjà pris !";
            }
        }
        else
        {
            $erreur = "Votre Login ne doit pas dépasser 30 caractères !";
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
<title>Inscription</title>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
</head>

<body>
<main>
<section>
<h2>Inscription</h2>
</section>
<?php if (isset($erreur))
{
    echo '<font color="red">' . $erreur . '</font>';
}
?>
<form action="inscription.php" method="post">
  <section> 
      <label for="login">Login</label>
      <input type="text" id="login" name="login"/>
      <label for="nom">Nom</label>
      <input type="text" id="nom" name="nom"/>
      <label for="prenom">Prenom</label>
      <input type="text" id="prenom" name="prenom"/>
      <label for="password">Votre mot de passe</label>
      <input type="password" id="password" name="password"/>
      <label for="passwordconfirm">Ressaisissez votre mot de passe</label>
      <input type="password" id="passwordconfirm" name="passwordconfirm"/>
      <input type="submit" name="Inscription" value="Valider"/></br>
   </section>
</form>
<section>
<a class="button" href="connexion.php">Se connecter</a>
</section>
</main>
</body>
</html>
