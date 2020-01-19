<?php

class Connexion
{
    public static $bdd = null;

    public function startConnexion()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=chat;charset=utf8";
            $username = "root";
            $pswd = "";
            self::$bdd = new PDO($dsn, $username, $pswd, array(PDO::ATTR_PERSISTENT => TRUE));
            return self::$bdd;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getConnexion()
    {
        if (self::$bdd == null) {
            $this->startConnexion();
        }
        return self::$bdd;
    }

    public function closeConnexion()
    {
        self::$bdd = null;
    }
}
