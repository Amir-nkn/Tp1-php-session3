<?php

require_once('classes/CRUD.php');
$crud = new CRUD;
if (isset($_POST['id']) && !empty($_POST['id'])) {
    if ($crud->delete('product', $_POST['id'])) {
        header('location:index.php');
    } else {
        echo "Error deleting product";
    }
} else {
    header('location:index.php');
}
