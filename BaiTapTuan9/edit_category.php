<?php
require_once 'Category_Database.php';

$category_Database = new Category_Database();

// Kiểm tra nếu có ID trong URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $category = $category_Database->getCategoryById($id);
}

// Kiểm tra nếu người dùng gửi form cập nhật
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];

    // Gọi hàm cập nhật danh mục trong database
    $category_Database->updateCategoryById($id, $name);
    header("Location: quanlydoanhmuc.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $category['name']; ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
