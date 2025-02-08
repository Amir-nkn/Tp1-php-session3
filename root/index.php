<?php
require_once(__DIR__ . '/classes/CRUD.php');
$crud = new CRUD;
$products = $crud->select('product', 'id', 'ASC');
?>
<link rel="stylesheet" href="css/style.css">


<div class="table-header">
    <h2>Product List</h2>
    <a href="create.php" class="btn">➕ Add Your Product</a>
</div>

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
            <?php foreach ($products as $row) {
            
                $category = $crud->selectId('category', $row['category_id']);
                $categoryName = $category ? htmlspecialchars($category['name']) : 'Non classé';
            ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td><?= number_format($row['price'], 2); ?> €</td>
                    <td><?= (int)$row['quantity']; ?></td>
                    <td><?= $categoryName; ?></td>
                    <td><a href="show.php?id=<?= $row['id']; ?>" class="btn">View</a></td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <input type="submit" class="btn red" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7" style="text-align: center;">Aucun produit trouvé</td>
            </tr>
        <?php } ?>
    </tbody>
</table>