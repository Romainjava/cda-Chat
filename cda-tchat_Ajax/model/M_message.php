<?php

class M_message extends Connexion
{

    public function readAllMessage(): array
    {
        $arrays = [];
        try {
            $pdo = $this->getConnexion();
            $query = $pdo->prepare('SELECT * FROM `conversation` ');
            $query->execute();
            $arrays = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $arrays;
    }

    public function createMessage(string $pseudo, string $message): bool
    {
        $result = 0;
        try {
            $pdo = $this->getConnexion();
            $query = $pdo->prepare('INSERT INTO `conversation`(message_conversation,pseudo_conversation)
                                    VALUES (:messageU,:pseudo)');
            $query->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $query->bindParam(':messageU', $message, PDO::PARAM_STR);
            $query->execute();
            $result = $query->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return ($result > 0);
    }

    public function readLastTime()
    {
        $result = false;
        try {
            $pdo = $this->getConnexion();
            $query = $pdo->prepare("SELECT UNIX_TIMESTAMP(`time`) FROM `conversation` ORDER BY `time` DESC LIMIT 1");
            $query->execute();
           $result =  $query->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       return $result;
    }
}
