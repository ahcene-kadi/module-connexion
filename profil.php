<?php
session_start();
include_once ('connexiondb.php');
if (isset($_SESSION['id']))
{
    $requser = $BDD->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $requser->execute(array(
        $_SESSION['id']
    ));
    $user = $requser->fetch();
    if (isset($_POST['newlogin']) and !empty($_POST['newlogin']) and $_POST['newlogin'] != $user['login'])
    {
        $newlogin = htmlspecialchars($_POST['newlogin']);
        $insertlogin = $BDD->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        $insertlogin->execute(array(
            $newlogin,
            $_SESSION['id']
        ));
        header('Location: index.php?id=' . $_SESSION['id']);
    }
    if (isset($_POST['newnom']) and !empty($_POST['newnom']) and $_POST['newnom'] != $user['nom'])
    {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $BDD->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
        $insertnom->execute(array(
            $newnom,
            $_SESSION['id']
        ));
        header('Location: index.php?id=' . $_SESSION['id']);
    }
    if (isset($_POST['newprenom']) and !empty($_POST['newprenom']) and $_POST['newprenom'] != $user['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $BDD->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array(
            $newprenom,
            $_SESSION['id']
        ));
        header('Location: index.php?id=' . $_SESSION['id']);
    }
    if (isset($_POST['newpassword']) and !empty($_POST['newpassword']) and isset($_POST['newpassword2']) and !empty($_POST['newpassword2']))
    {
        $password = htmlspecialchars($_POST['newpassword']);
        $password2 = htmlspecialchars($_POST['newpassword2']);
        if ($mdp1 == $mdp2)
        {
            $insertpassword = $BDD->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $insertpassword->execute(array(
                $password,
                $_SESSION['id']
            ));
            header('Location: index.php?id=' . $_SESSION['id']);
        }
        else
        {
            $erreur = "Vos mots de passes ne correspondent pas !";
        }
    }
?>

<html lang=fr>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Espace membre</title>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
</head>

<body>
<main>
<section>
<h2>Votre profil</h2>
</section>
<?php if (isset($erreur))
    {
        echo '<font color="red">' . $erreur . '</font>';
    }
?>
<section>
<form action="profil.php" method="POST" enctype="multipart/form-data">
                  
    <label for="Login">Login</label>
    <input type="text" id="login" name="newlogin" value="<?php echo $user['login']; ?>" />
    <label for="Nom">Nom</label>
    <input type="text" id="Nom" name="newnom" value="<?php echo $user['nom']; ?>"/>
    <label for="Prenom">Prenom</label>
	<input type="text" id="Prenom" name="newprenom" value="<?php echo $user['prenom']; ?>"/>
    <label for="password">Votre mot de passe</label>
    <input type="password" id="password" name="newpassword" required/>
    <label for="passwordchange">Nouveau mot de passe</label>
	<input type="password" id="passwordchange" name="newpassword2" required/>
    <label for="Modifier"></label>
    <input type="submit" id="Modifier" value="Modifier"/></br>
                  
</form>
</section>
<section>
<a class="button" href="index.php">Retour</a>
</section>
</main>
</body>
</html>
<?php
}
else
{
    header("Location: connexion.php");
}
?>
