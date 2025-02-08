<?php
require_once('classes/CRUD.php');
$crud = new CRUD;
$insert = $crud->insert('product', $_POST);

if ($insert) {
    header('Location: index.php'); 
    exit();
} else {
    echo "Error adding product.";
}
?>
