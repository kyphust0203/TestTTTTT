<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div class="table-container">
        <h1>Quản Lý Danh Mục</h1>

        <?php
        require_once 'Category_Database.php';
        $category_Database = new Category_Database();

        // Xử lý biểu mẫu thêm danh mục
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
            $name = $_POST['name'];
            if (!empty($name)) {
                $success = $category_Database->addCategory($name);
                if ($success) {
                    echo "<p class='success-message'>Thêm danh mục thành công!</p>";
                } else {
                    echo "<p class='error-message'>Có lỗi xảy ra khi thêm danh mục!</p>";
                }
            } else {
                echo "<p class='error-message'>Vui lòng nhập tên danh mục.</p>";
            }
        }

        // Lấy danh sách các danh mục để hiển thị
        $categories = $category_Database->getAllCategories();
        ?>

        <!-- Biểu mẫu Thêm Danh Mục -->
        <form method="POST" action="quanlydoanhmuc.php" class="add-category-form">
            <label for="name">Tên danh mục mới:</label>
            <input type="text" id="name" name="name" placeholder="Nhập tên danh mục" required>
            <button type="submit">Thêm</button>
        </form>

        <!-- Bảng danh mục -->
        <table>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['name']; ?></td>
                    <td class="action-links">
                        <!-- Nút Sửa -->
                        <a href="edit_category.php?id=<?php echo $category['id']; ?>">Sửa</a>
                        <!-- Nút Xóa -->
                        <a href="category_process.php?id=<?php echo $category['id']; ?>&action=delete" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>