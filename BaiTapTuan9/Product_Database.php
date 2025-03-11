<?php
require_once 'Database.php';

class Product_Database extends Database
{
    public function getAllProducts()
    {
        $sql = self::$connection->prepare("SELECT * FROM Product");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }


    public function getProductById($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM Product where id=?");
        $sql->bind_param("i", $id);
        $sql->execute(); //return an object

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items[0]; //return an array
    }

    public function getProductsByCategoryId($category_id)
    {
        //$sql = self::$connection->prepare("SELECT * FROM Product, Category where Category.id=? and category.id=product.category_id");
        $sql = self::$connection->prepare("SELECT * FROM Product where category_id=?");
        $sql->bind_param("i", $category_id);
        $sql->execute(); //return an object

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function search($keyword)
    {
        $cmd = "SELECT * FROM product WHERE `name` LIKE '%$keyword%'";
        $sql = self::$connection->prepare($cmd);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function search_total($keyword)
    {
        $cmd = "SELECT count(*) as total FROM product WHERE `name` LIKE '%$keyword%'";
        $sql = self::$connection->prepare($cmd);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_assoc();
        return $items['total'];
    }

    public function search_pagination($keyword, $page, $perPage)
    {
        $startRecord = ($page - 1) * $perPage;
        $keyword2 = "%$keyword%";

        $cmd = "SELECT * FROM product WHERE `name` LIKE ? LIMIT ? , ?";
        $sql = self::$connection->prepare($cmd);

        $sql->bind_param("sii", $keyword2, $startRecord, $perPage);

        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }

    public function paginationBar($url, $page, $perPage, $total)
    {
        $links = "";

        $maxPage = ceil($total / $perPage);

        for ($i = 1; $i <= $maxPage; $i++) {
            $links .= "<a href='$url&page=$i'>$i</a>  ";
        }

        return $links;
    }

    
}
