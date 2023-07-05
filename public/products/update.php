<?php

/** @var $pdo \PDO  */
require_once "../../database.php";
require_once "../../functions.php";
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}
$statement = $pdo->prepare("SELECT * FROM products WHERE id=:id");
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);
$errors = [];
$title = $product['title'];
$description = $product['description'];
$price = $product['price'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../../validation_products.php";
    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE products SET image = :image, title = :title, description = :description, price = :price
         WHERE id = :id ");
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id);
        $statement->execute();
        header('Location: index.php');
    }
}
?>
<?php include_once "../../views/partials/header.php"; ?>

<body>
    <p>
        <a href="index.php" class="btn btn-secondary">Back to Products</a>
    </p>
    <h1>Update Product <?php echo $product['title'] ?></h1>
    <?php include_once "../../views/products/form.php" ?>
</body>

</html>