<?php
session_start();
include_once ('connexiondb.php');

if ($_SESSION['login'] != 'admin')
{
    header('Location: index.php');
}

$reqadmin = $BDD->prepare('SELECT id, login, prenom, nom, password FROM utilisateurs');
$reqadmin->setFetchMode(PDO::FETCH_ASSOC);
$reqadmin->execute();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin</title>
   <link rel="stylesheet" href="style.css">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
</head>
<body>
<main>
    <h2>Espace administrateur</h2>
<?php
echo '<table>';
$i = 0;
while ($tab = $reqadmin->fetch())
{
   if ($i == 0)
   {
      echo '<thead>';
      foreach ($tab as $key => $value)
      {
         echo '<th>' . $key . '</th>';
      }
        echo '</thead>';
        $i = 1;
   }
      echo '<tr>';
      foreach ($tab as $value)
   {
      echo '<td>' . $value . '</td>';
   }
   echo '</tr>';
}
echo '</table>';

$BDD = null;
$reqadmin = null;
?>
  </main>
  <a class="button" href="index.php">Retour</a>
  </body>
