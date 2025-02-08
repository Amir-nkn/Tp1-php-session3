<?php
// Inclusion de la classe CRUD
require_once('classes/CRUD.php');

// Création d'une nouvelle instance de la classe CRUD
$crud = new CRUD;

// Tentative de mise à jour des données du produit
if($crud->update('product', $_POST)){
    // Redirection vers la page d'index si la mise à jour est réussie
    header('location:index.php');
} else {
    // Affichage d'un message d'erreur si la mise à jour échoue
    echo "Error updating product";
}
?>
