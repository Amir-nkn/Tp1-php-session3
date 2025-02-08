<?php
// Vérification si un identifiant de produit est passé dans l'URL
if (isset($_GET['id']) && $_GET['id'] != null) {
    // Récupération de l'ID du produit depuis l'URL
    $id = $_GET['id'];

    // Inclusion de la classe CRUD pour interagir avec la base de données
    require_once('classes/CRUD.php');

    // Création d'une instance de la classe CRUD
    $crud = new CRUD;

    // Sélection du produit par ID
    $product = $crud->selectId('product', $id);

    // Si le produit existe, extraire les données du produit
    if ($product) {
        extract($product);
        
        // Récupération de la catégorie du produit
        $category = $crud->selectId('category', $category_id);
        // Si la catégorie existe, on utilise son nom, sinon 'Uncategorized'
        $categoryName = $category ? $category['name'] : 'Uncategorized';
    } else {
        // Si le produit n'existe pas, redirection vers la page d'index
        header('location:index.php');
        exit;
    }
} else {
    // Si l'ID n'est pas présent dans l'URL, redirection vers la page d'index
    header('location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <!-- Formulaire pour éditer les informations du produit -->
        <form action="update.php" method="post">
            <h2>Edit Product</h2>
            
            <!-- Champ caché pour l'ID du produit -->
            <input type="hidden" name="id" value="<?= $id; ?>">

            <!-- Champ pour le nom du produit -->
            <label>Name
                <input type="text" name="name" id="name" value="<?= $name; ?>" required>
            </label>

            <!-- Champ pour la description du produit -->
            <label>Description
                <textarea name="description" id="description" required><?= $description; ?></textarea>
            </label>

            <!-- Champ pour le prix du produit -->
            <label>Price
                <input type="number" step="0.01" name="price" id="price" value="<?= $price; ?>" required>
            </label>

            <!-- Champ pour la quantité du produit -->
            <label>Stock
                <input type="number" name="quantity" id="quantity" value="<?= $quantity; ?>" required>
            </label>

            <!-- Sélection de la catégorie du produit -->
            <label>Category
                <select name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    // Récupération des catégories depuis la base de données
                    $categories = $crud->select('category', 'name', 'ASC');
                    foreach ($categories as $category) {
                        // Pré-sélectionner la catégorie correspondant au produit
                        $selected = ($category['id'] == $category_id) ? 'selected' : '';
                        echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                    }
                    ?>
                </select>
            </label>

            <!-- Bouton pour soumettre le formulaire de mise à jour -->
            <input type="submit" value="Update" class="btn">
            
            <!-- Lien pour revenir à la page précédente -->
            <a href="javascript:history.back()" class="btn back">Back</a>
        </form>
    </div>
</body>

</html>
