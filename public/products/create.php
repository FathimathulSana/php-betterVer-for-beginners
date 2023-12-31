<?php

require_once "../../database.php";
require_once "../../functions.php";
$errors = [];
$title = '';
$description = '';
$price = '';
$product = [
    'image' => ''
];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../../validation_products.php";
    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO products(image,title,description,price,create_date)
               VALUES(:image,:title,:description,:price,:date)");
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));
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
    <h1>Create Product</h1>
    <?php include_once "../../views/products/form.php" ?>
</body>

</html>