<?php

// Inclusion de la classe CRUD pour interagir avec la base de données
require_once('classes/CRUD.php');

// Création d'une instance de la classe CRUD
$crud = new CRUD;

// Vérification si l'ID du produit est passé via la méthode POST et si l'ID n'est pas vide
if (isset($_POST['id']) && !empty($_POST['id'])) {
    // Si la suppression du produit dans la base de données réussit
    if ($crud->delete('product', $_POST['id'])) {
        // Redirection vers la page d'accueil après suppression
        header('location:index.php');
    } else {
        // Si une erreur survient lors de la suppression, afficher un message d'erreur
        echo "Error deleting product";
    }
} else {
    // Si l'ID du produit n'est pas trouvé ou est vide, redirection vers la page d'accueil
    header('location:index.php');
}
