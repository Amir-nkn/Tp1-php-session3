<?php
if (isset($_GET['id']) && $_GET['id'] != null) {    
    $id = $_GET['id'];
    require_once('classes/CRUD.php');
    $crud = new CRUD;
    $product = $crud->selectId('product', $id);
    
    if ($product) {
        
        $name = $product['name'] ?? 'N/A';
        $description = $product['description'] ?? 'No description';
        $price = $product['price'] ?? 0.00;
        $quantity = $product['quantity'] ?? 0;
        
    
        $category_id = $product['category_id'] ?? null;
        $category = $crud->selectId('category', $category_id);
        $categoryName = $category ? $category['name'] : 'Uncategorized';
    } else {
        header('location:index.php');
        exit;
    }
} else {
    header('location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="product-card">
        <h1>Product Details</h1>
        <p><strong>Name: </strong><?= htmlspecialchars($name); ?></p>
        <p><strong>Description: </strong><?= htmlspecialchars($description); ?></p>
        <p><strong>Price: </strong>$<?= number_format($price, 2); ?></p>
        <p><strong>Stock: </strong><?= (int)$quantity; ?></p>
        <p><strong>Category: </strong><?= htmlspecialchars($categoryName); ?></p>
        <a href="edit.php?id=<?= $id; ?>" class="btn-edit">Edit</a>
    </div>
</body>
</html>
