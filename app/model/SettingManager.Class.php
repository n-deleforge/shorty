<?php
class SettingManager
{
    public static function add(Setting $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("INSERT INTO setting (key,value) VALUES (:key,:value)");
        $q->bindValue(":key", $obj->getKey());
        $q->bindValue(":value", $obj->getValue());
        $q->execute();
    }

    public static function update(Setting $obj)
    {
        $db = DbConnect::getDb();
        $q = $db->prepare("UPDATE setting SET key=:key, value=:value WHERE id=:id");
        $q->bindValue(":key", $obj->getKey());
        $q->bindValue(":value", $obj->getValue());
        $q->bindValue(":id", $obj->getId());
        $q->execute();
    }

    public static function delete(Setting $obj)
    {
        $db = DbConnect::getDb();
        $db->exec("DELETE FROM setting WHERE id=" . $obj->getId());
    }

    public static function findById($id)
    {
        $db = DbConnect::getDb();
        $id = (int) $id;
        $q = $db->query("SELECT * FROM setting WHERE id=" . $id);
        $results = $q->fetcharray(PDO::FETCH_OBJ);
        return ($results != false) ? new Setting($results) : false;
    }

    public static function getList()
    {
        $db = DbConnect::getDb();
        $arr = [];
        $q = $db->query("SELECT * FROM setting");
        while ($donnees = $q->fetcharray(PDO::FETCH_OBJ)) if ($donnees != false) $arr[] = new Setting($donnees);
        return $arr;
    }

    public static function findByKey($key)
    {
        $db = DbConnect::getDb();
        $q = $db->query("SELECT * FROM setting WHERE key='" . $key . "'");
        $results = $q->fetcharray(PDO::FETCH_OBJ);
        return ($results != false) ? new Setting($results) : false;
    }
}
