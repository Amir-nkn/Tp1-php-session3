<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <!-- Formulaire pour ajouter un nouveau produit -->
        <form action="store.php" method="post">
            <h2>New Product</h2>

            <!-- Champ pour le nom du produit -->
            <label>Name
                <input type="text" name="name" required>
            </label>

            <!-- Champ pour la description du produit -->
            <label>Description
                <textarea name="description" required></textarea>
            </label>

            <!-- Champ pour le prix du produit -->
            <label>Price
                <input type="number" step="0.01" name="price" required>
            </label>

            <!-- Champ pour la quantité en stock du produit -->
            <label>Stock
                <input type="number" name="quantity" required>
            </label>

            <!-- Liste déroulante pour sélectionner la catégorie du produit -->
            <label>Category
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    // Inclusion de la classe CRUD pour récupérer les catégories depuis la base de données
                    require_once('classes/CRUD.php');
                    $crud = new CRUD;

                    // Récupération des catégories depuis la base de données, triées par nom
                    $categories = $crud->select('category', 'name', 'ASC');
                    // Affichage de chaque catégorie dans la liste déroulante
                    foreach ($categories as $category) {
                        echo "<option value='{$category['id']}'>{$category['name']}</option>";
                    }
                    ?>
                </select>
            </label>

            <!-- Bouton pour soumettre le formulaire et enregistrer le produit -->
            <input type="submit" value="Save" class="btn">
        </form>
    </div>
</body>

</html>
