<?php
require_once('classes/CRUD.php');
$crud = new CRUD;
if($crud->update('product', $_POST)){
    header('location:index.php');
} else {
    echo "Error updating product";
}
?>
