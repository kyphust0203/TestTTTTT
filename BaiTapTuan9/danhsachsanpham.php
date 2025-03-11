<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Danh Sách Sản Phẩm</title>
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
	<style>
		/* Căn chỉnh nút */
		.button-container {
			text-align: center;
			margin-top: 20px;
		}

		.button-container button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			font-size: 16px;
			cursor: pointer;
			margin: 5px;
			border-radius: 5px;
			transition: background-color 0.3s ease;
		}

		.button-container button:hover {
			background-color: #45a049;
		}

		.button-container a {
			color: white;
			text-decoration: none;
		}

		/* Giao diện sản phẩm */
		.sanpham {
			border: 1px solid #ddd;
			border-radius: 8px;
			padding: 15px;
			margin: 15px;
			text-align: center;
			width: 100%;
			max-width: 200px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			transition: box-shadow 0.3s ease;
		}

		.sanpham img {
			max-width: 100%;
			height: auto;
			border-radius: 8px;
			transition: transform 0.3s ease;
		}

		.sanpham:hover {
			box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
		}

		.sanpham img:hover {
			transform: scale(1.1);
		}

		.sanpham h1 a {
			text-decoration: none;
			color: #333;
			font-size: 18px;
			font-weight: bold;
			transition: color 0.3s ease;
		}

		.sanpham h1 a:hover {
			color: #4CAF50;
		}

		.sanpham .gia {
			color: #e91e63;
			font-weight: bold;
			font-size: 16px;
		}

		.sanpham p {
			font-size: 14px;
			color: #555;
		}

		.addcart {
			display: inline-block;
			margin-top: 10px;
			padding: 8px 12px;
			background-color: #2196F3;
			color: white;
			border-radius: 4px;
			text-decoration: none;
			transition: background-color 0.3s ease;
		}

		.addcart:hover {
			background-color: #0b7dda;
		}

		/* Căn chỉnh lưới sản phẩm */
		.products-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
			gap: 15px;
			padding: 20px;
			justify-content: center;
		}
	</style>
</head>

<body>
	<div class="button-container">
		<button><a href="view_cart.php">View Cart</a></button>
		<button><a href="trang1.php">Trang Chủ</a></button>
	</div>

	<div class="products-grid">
		<?php
		require_once('data_product.php');
		foreach ($products as $product) :
		?>
			<div class='sanpham'>
				<img src="public/images/<?php echo $product['image'] ?>" alt="Product Image">
				<h1><a href='chitietsanpham.php?id=<?php echo $product['id']; ?>'> <?= $product['name']; ?> </a></h1>
				<b>Giá: </b> <span class='gia'><?= $product['price'] ?></span><br>
				<p>
					<?php
					$desc = $product['desc'];
					$words = explode(" ", substr($desc, 0, 85));
					echo implode(" ", array_slice($words, 0, -1));
					?>
					<a href='chitietsanpham.php?id=<?php echo $product['id']; ?>'>[...]</a>
				</p>
				<a class="addcart" href="<?= 'add_cart.php?id=' . $product['id'] ?>">Add To Cart</a>
			</div>
		<?php endforeach; ?>
	</div>
</body>

</html>
