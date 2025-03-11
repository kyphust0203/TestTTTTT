<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <title>Giỏ Hàng</title>
    <style>
        .center {
            margin-left: auto;
            margin-right: auto;
            width: 80%;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f8f9fa;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table td {
            border-bottom: 1px solid #ddd;
        }

        .total-row {
            font-weight: bold;
            color: #e91e63;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #218838;
        }

        .delete-btn {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }

        .delete-btn:hover {
            color: #c82333;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    require_once('data_product.php');

    $carts = $_SESSION['addcart'];
    $sum = 0;
    echo "<div class='text-center'>
        <h2 class='mt-4'>Giỏ Hàng</h2>
        <table class='center table'>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Tổng Tiền</th>
                <th>Thao Tác</th>
            </tr>";
    foreach($carts as $idkey => $value){
        foreach($products as $product){
            if($idkey == $product['id']){
                echo "<tr>
                        <td>".$product['id']."</td>
                        <td>".$product['name']."</td>
                        <td>".$product['price']." $</td>
                        <td>".$value."</td>
                        <td>".$product['price']*$value." $</td>
                        <td><a href='remove_product_cart.php?id=".$product['id']."' class='delete-btn'>Xóa</a></td>
                      </tr>";
                $sum += $product['price'] * $value;
            }
        }
    }
    echo "<tr class='total-row'>
            <td colspan='4'>Tổng Số Tiền</td>
            <td colspan='2'>".$sum." $</td>
        </tr>
        </table>
        <div class='button-container'>
            <a href='danhsachsanpham.php' class='btn-custom'>Tiếp Tục Mua Sắm</a>
            <a href='trang1.php' class='btn-custom'>Trở Về Trang Chủ</a>
        </div>
    </div>";
    ?>
</div>
</body>
</html>
