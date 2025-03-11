<?php
require_once 'Category_Database.php';
$category_Database = new Category_Database();


if (isset($_GET['action']) && $_GET['action'] == 'add') {
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
        $success = $category_Database->addCategory($name);
        if ($success) {
            header("Location: quanlydoanhmuc.php");
            exit();
        } else {
            echo "Loi!";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $success = $category_Database->deleteCategoryById($id);
        if ($success) {
            header("Location: quanlydoanhmuc.php");
            exit();
        } else {
            echo "Loi!";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'update') {
    if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $success = $category_Database->updateCategoryById($id, $name);
        if ($success) {
            header("Location: quanlydoanhmuc.php");
            exit();
        } else {
            echo "Loi!";
        }
    }
}
