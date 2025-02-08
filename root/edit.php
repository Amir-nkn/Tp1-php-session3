<?php
if (isset($_GET['id']) && $_GET['id'] != null) {
    $id = $_GET['id'];
    require_once('classes/CRUD.php');
    $crud = new CRUD;
    $product = $crud->selectId('product', $id);
    if ($product) {
        extract($product);
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
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <form action="update.php" method="post">
            <h2>Edit Product</h2>
            <input type="hidden" name="id" value="<?= $id; ?>">

            <label>Name
                <input type="text" name="name" id="name" value="<?= $name; ?>" required>
            </label>

            <label>Description
                <textarea name="description" id="description" required><?= $description; ?></textarea>
            </label>

            <label f>Price
                <input type="number" step="0.01" name="price" id="price" value="<?= $price; ?>" required>
            </label>

            <label>Stock
                <input type="number" name="quantity" id="quantity" value="<?= $quantity; ?>" required>
            </label>

            <label>Category
                <select name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    $categories = $crud->select('category', 'name', 'ASC');
                    foreach ($categories as $category) {
                        $selected = ($category['id'] == $category_id) ? 'selected' : '';
                        echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                    }
                    ?>
                </select>
            </label>

            <input type="submit" value="Update" class="btn">
            <a href="javascript:history.back()" class="btn back">Back</a>
        </form>
    </div>
</body>

</html>