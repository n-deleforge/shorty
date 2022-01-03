<?php
class RedirectionManager
{
    public static function add(Redirection $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO redirection (key,url) VALUES (:key,:url)");
        $q->bindValue(":key", $obj->getKey());
        $q->bindValue(":url", $obj->getUrl());
        $q->execute();
    }

    public static function update(Redirection $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE redirection SET key=:key, url=:url WHERE id=:id");
        $q->bindValue(":key", $obj->getKey());
        $q->bindValue(":url", $obj->getUrl());
        $q->bindValue(":id", $obj->getId());
        $q->execute();
    }

    public static function delete(Redirection $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM redirection WHERE id=" . $obj->getId());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM redirection WHERE id=" . $id);
        $results = $q->fetcharray(PDO::FETCH_OBJ);
        return ($results != false) ? new Redirection($results) : false;
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $arr = [];
        $q = $db->query("SELECT * FROM redirection");
        while ($donnees = $q->fetcharray(PDO::FETCH_OBJ)) if ($donnees != false) $arr[] = new Redirection($donnees);
        return $arr;
    }
}
