<?php
// Vérification si un identifiant de produit est passé dans l'URL
if (isset($_GET['id']) && $_GET['id'] != null) {    
    // Récupération de l'ID du produit depuis l'URL
    $id = $_GET['id'];

    // Inclusion de la classe CRUD
    require_once('classes/CRUD.php');

    // Création d'une instance de la classe CRUD
    $crud = new CRUD;

    // Sélection du produit par ID
    $product = $crud->selectId('product', $id);
    
    // Si le produit existe, récupération de ses informations
    if ($product) {
        
        // Récupération des informations du produit, avec des valeurs par défaut si elles sont nulles
        $name = $product['name'] ?? 'N/A';
        $description = $product['description'] ?? 'No description';
        $price = $product['price'] ?? 0.00;
        $quantity = $product['quantity'] ?? 0;

        // Récupération de la catégorie du produit
        $category_id = $product['category_id'] ?? null;
        $category = $crud->selectId('category', $category_id);
        
        // Récupération du nom de la catégorie, ou 'Uncategorized' si la catégorie est introuvable
        $categoryName = $category ? $category['name'] : 'Uncategorized';
    } else {
        // Si le produit n'existe pas, redirection vers la page d'index
        header('location:index.php');
        exit;
    }
} else {
    // Si l'ID du produit n'est pas passé ou est nul, redirection vers la page d'index
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
        <!-- Affichage des détails du produit -->
        <p><strong>Name: </strong><?= htmlspecialchars($name); ?></p>
        <p><strong>Description: </strong><?= htmlspecialchars($description); ?></p>
        <p><strong>Price: </strong>$<?= number_format($price, 2); ?></p>
        <p><strong>Stock: </strong><?= (int)$quantity; ?></p>
        <p><strong>Category: </strong><?= htmlspecialchars($categoryName); ?></p>
        <!-- Lien pour éditer le produit -->
        <a href="edit.php?id=<?= $id; ?>" class="btn-edit">Edit</a>
    </div>
</body>
</html>
