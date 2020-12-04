<?php
class connexiondb
{
    private $host = 'localhost';
    private $name = 'moduleconnexion';
    private $user = 'root';
    private $pass = '';
    private $connexion;

    function __construct($host = null, $name = null, $user = null, $pass = null)
    {
        if ($host != null)
        {
            $this->host = $host;
            $this->host = $name;
            $this->host = $user;
            $this->host = $pass;
        }
        try
        {
            $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name, $this->user, $this->pass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8MB4',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            ));
        }
        catch(PDOException $e)
        {
            echo 'Erreur : Impossible de se connecter a la base de données !';
            die();
        }
    }
    public function connexion()
    {
        return $this->connexion;
    }
}
$DB = new connexiondb;
$BDD = $DB->connexion();
?>
