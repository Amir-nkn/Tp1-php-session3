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
        <form action="store.php" method="post">
            <h2>New Product</h2>
            <label>Name
                <input type="text" name="name" required>
            </label>
            <label>Description
                <textarea name="description" required></textarea>
            </label>
            <label>Price
                <input type="number" step="0.01" name="price" required>
            </label>
            <label>Stock
                <input type="number" name="quantity" required>
            </label>
            <label>Category
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                    require_once('classes/CRUD.php');
                    $crud = new CRUD;
                    $categories = $crud->select('category', 'name', 'ASC');
                    foreach ($categories as $category) {
                        echo "<option value='{$category['id']}'>{$category['name']}</option>";
                    }
                    ?>
                </select>
            </label>
            <input type="submit" value="Save" class="btn">
        </form>
    </div>
</body>

</html>