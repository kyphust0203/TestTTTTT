<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>Document</title>
    <style>
        .navbar {
            background-color: #4CAF50;
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #ffffff !important;
        }

        .navbar .nav-link:hover {
            color: #FFD700 !important;
        }

        .navbar-toggler {
            border-color: #ffffff;
        }

        .navbar-toggler-icon {
            background-color: #ffffff;
        }

        .pagination .page-link {
            color: #4CAF50;
        }

        .pagination .page-link:hover {
            background-color: #FFD700;
            color: white;
        }

        .pagination .active .page-link {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    require_once 'Category_Database.php';

    $category_Database1 = new Category_Database();
    $categories = $category_Database1->getAllCategories();

    $cate = $category_Database1->getCategoryById(2);
    ?>
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="trang1.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Brand</a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($categories as $category) {
                                echo '<li><a class="dropdown-item" href="trang1.php?category_id=' . $category['id'] . '">' . $category['name'] . ' </a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex ms-auto" action="" method="get">
                    <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <?php
    require_once 'Product_Database.php';

    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 3;

    $product_Database = new Product_Database();
    $products = [];

    if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $perPage = 1;
        $page = ($_GET['page']) ?? 1;

        $products = $product_Database->search_pagination($keyword, $page, $perPage);
        echo '<h2>Search Results for: ' . htmlspecialchars($keyword) . '</h2>';
    } elseif (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $products = $product_Database->getProductsByCategoryId($category_id);
        $danhmuc = $category_Database1->getCategoryById($category_id);
        echo '<h2>Các sản phẩm của loại ' . htmlspecialchars($danhmuc['name']) . '</h2>';
    } else {
        $products = $product_Database->getAllProducts();
        echo '<h2>Tất cả các sản phẩm</h2>';
    }

    foreach ($products as $product) :
    ?>
        <div class='sanpham'>
            <img src="public/images/<?php echo $product['image'] ?>" alt="Product Image">
            <h1><a href='chitietsanpham.php?id=<?php echo $product['id']; ?>'> <?= htmlspecialchars($product['name']); ?> </a></h1>
            <b>Giá: </b> <span class='gia'><?= htmlspecialchars($product['price']) ?></span><br>
            <p>
                <?php
                $desc = $product['desc'];
                $words = explode(" ", substr($desc, 0, 85));
                echo htmlspecialchars(implode(" ", array_slice($words, 0, -1)));
                ?>
                <a href='chitietsanpham.php?id=<?php echo $product['id']; ?>'>[...]</a>
            </p>
            <a class="addcart" href="<?= 'add_cart.php?id=' . $product['id'] ?>">Add To Cart</a>
        </div>
    <?php
    endforeach;

    $url = $_SERVER['PHP_SELF'] . "?keyword=" . $keyword;
    $total = $product_Database->search_total($keyword);

    $currentPage = $page;
    $totalPages = ceil($total / $perPage);

    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination justify-content-center">';

    if ($currentPage > 1) {
        echo '<li class="page-item"><a class="page-link" href="' . $url . '&page=1"><<</a></li>';
        echo '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . ($currentPage - 1) . '"><</a></li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . $i . '">' . $i . '</a></li>';
        }
    }

    if ($currentPage < $totalPages) {
        echo '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . ($currentPage + 1) . '">></a></li>';
        echo '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . $totalPages . '">>></a></li>';
    }

    echo '</ul>';
    echo '</nav>';
    ?>
</body>

</html>
