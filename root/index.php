<?php
// Inclusion de la classe CRUD
require_once(__DIR__ . '/classes/CRUD.php');

// Création d'une instance de la classe CRUD
$crud = new CRUD;

// Récupération de tous les produits depuis la base de données, triés par ID dans l'ordre croissant
$products = $crud->select('product', 'id', 'ASC');
?>
<link rel="stylesheet" href="css/style.css">

<!-- Entête du tableau avec un titre et un bouton pour ajouter un produit -->
<div class="table-header">
    <h2>Product List</h2>
    <!-- Lien pour ajouter un produit -->
    <a href="create.php" class="btn">➕ Add Your Product</a>
</div>

<!-- Tableau des produits -->
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Category</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($products)) { ?>
            <!-- Boucle pour afficher chaque produit -->
            <?php foreach ($products as $row) {
            
                // Récupération du nom de la catégorie associée au produit
                $category = $crud->selectId('category', $row['category_id']);
                $categoryName = $category ? htmlspecialchars($category['name']) : 'Non classé';
            ?>
                <tr>
                    <!-- Affichage des informations de chaque produit -->
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td><?= number_format($row['price'], 2); ?> €</td>
                    <td><?= (int)$row['quantity']; ?></td>
                    <td><?= $categoryName; ?></td>
                    <!-- Lien pour voir les détails du produit -->
                    <td><a href="show.php?id=<?= $row['id']; ?>" class="btn">View</a></td>
                    <td>
                        <!-- Formulaire pour supprimer un produit -->
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <input type="submit" class="btn red" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <!-- Si aucun produit n'est trouvé, afficher un message -->
            <tr>
                <td colspan="7" style="text-align: center;">Aucun produit trouvé</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
