<?php

class M_users extends Connexion
{   
    /**
     * Recuperer les données d'un utilisateur
     */
    public function checkUserData(string $pseudo): array
    {
        $arrays = [];
        try {
            $pdo = $this->getConnexion();
            $query = $pdo->prepare('SELECT * FROM utilisateur WHERE pseudo_utilisateur = :pseudo');
            $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->execute();
            $arrays = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $arrays;
    }

    public function readAllMessageUsers(): array
    {
        $arrays = [];
        try {
            $pdo = $this->getConnexion();
            $query = $pdo->prepare('SELECT pseudo_utilisateur as pseudo, message_utilisateur as messageU FROM utilisateur');
            $query->execute();
            $arrays = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $arrays;
    }


    /**
     * Met à jour un message d'un utilisateur par rapport à son id
     */
    public function updateUserMessageById(int $id, string $message): bool
    {
        $result = false;
        try {
            $pdo = $this->getConnexion();
            $query = $pdo->prepare('UPDATE utilisateur SET message_utilisateur =
                                    WHERE id_utilisateur = :id');
            $query->bindParam(':messageU', $message, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $result =  $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }
    /**
     * Crée un nouveau utilisateur avec son message
     */
    public function insertMessageByNewUser(string $message, string $pseudo): bool
    {
        $result = 0;
        try {
            $pdo = $this->getConnexion();
            $query = $pdo->prepare('INSERT INTO utilisateur(pseudo_utilisateur,message_utilisateur)
                                    VALUES (:pseudo,:messageU)');
            $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->bindParam(':messageU', $message, PDO::PARAM_STR);
            $query->execute();
            $result = $query->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return ($result > 0);
    }
}
