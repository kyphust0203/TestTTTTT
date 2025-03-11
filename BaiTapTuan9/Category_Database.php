<?php
require_once 'Database.php';

class Category_Database extends Database
{
    public function getAllCategories()
    {
        $sql = self::$connection->prepare("SELECT * FROM Category");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }


    public function getCategoryById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM Category where id=?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items[0];
    }
    public function deleteCategoryById($id)
    {
        $sql = self::$connection->prepare("DELETE FROM Category WHERE id = ?");
        $sql->bind_param("i", $id);
        $result = $sql->execute();

        return $result;
    }
    public function updateCategoryById($id, $name)
    {
        $sql = self::$connection->prepare("UPDATE Category SET name = ? WHERE id = ?");
        $sql->bind_param("si", $name, $id);
        return $sql->execute();
    }

    public function addCategory($name)
    {
        $sql = self::$connection->prepare("INSERT INTO Category (name) VALUES (?)");
        $sql->bind_param("s", $name);
        $result = $sql->execute();

        return $result;
    }
}
