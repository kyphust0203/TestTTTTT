<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Detail</title>
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f9;
			margin: 0;
			padding: 20px;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			background: #ffffff;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			padding: 20px;
		}

		.sanpham {
			text-align: center;
		}

		.sanpham img {
			max-width: 300px;
			height: auto;
			border-radius: 8px;
			margin-bottom: 20px;
		}

		.sanpham h1 {
			color: #333;
			font-size: 24px;
		}

		.sanpham h1 a {
			text-decoration: none;
			color: #4CAF50;
		}

		.sanpham h1 a:hover {
			color: #2E7D32;
		}

		.sanpham .gia {
			color: #e91e63;
			font-weight: bold;
			font-size: 20px;
		}

		.sanpham p {
			font-size: 16px;
			color: #555;
			margin: 15px 0;
		}

		.addcart {
			display: inline-block;
			padding: 10px 20px;
			background-color: #2196F3;
			color: white;
			border-radius: 4px;
			text-decoration: none;
			font-size: 16px;
			margin-top: 20px;
			transition: background-color 0.3s ease;
		}

		.addcart:hover {
			background-color: #0b7dda;
		}

		.button-container {
			margin-top: 20px;
			text-align: center;
		}

		.button-container a {
			text-decoration: none;
			color: white;
			padding: 10px 20px;
			border-radius: 5px;
			margin: 10px;
			display: inline-block;
			font-size: 16px;
			transition: background-color 0.3s ease;
		}

		.button-container .category-button {
			background-color: #4CAF50;
		}

		.button-container .category-button:hover {
			background-color: #388E3C;
		}

		.button-container .home-button {
			background-color: #f44336;
		}

		.button-container .home-button:hover {
			background-color: #d32f2f;
		}
	</style>
</head>

<body>
	<?php
	require_once 'Product_Database.php';
	require_once 'Category_Database.php';

	$product_Database = new Product_Database();
	$products = $product_Database->getAllProducts();

	if (isset($_GET['id'])) {
		foreach ($products as $product) :
			if ($_GET['id'] == $product['id']) {
				$category_Database = new Category_Database();
				$danhmuc = $category_Database->getCategoryById($product['category_id']);
	?>
				<div class="container">
					<div class="button-container">
						<a class="category-button" href="trang1.php?category_id=<?= $danhmuc['id'] ?>">Loại <?= htmlspecialchars($danhmuc['name']); ?></a>
						<a class="home-button" href="trang1.php">Trang Chủ</a>
					</div>

					<div class="sanpham">
						<img src="public/images/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
						<h1><a href='chitietsanpham.php?id=<?php echo $product['id']; ?>'><?= htmlspecialchars($product['name']); ?></a></h1>
						<p><b>Giá: </b> <span class='gia'><?= htmlspecialchars($product['price']); ?> VNĐ</span></p>
						<p><?= nl2br(htmlspecialchars($product['desc'])); ?></p>
						<a class="addcart" href="<?= 'add_cart.php?id=' . $product['id']; ?>">Add To Cart</a>
					</div>
				</div>
	<?php
			}
		endforeach;
	}
	?>
</body>

</html>
