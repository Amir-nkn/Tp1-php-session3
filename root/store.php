<?php
// Inclusion de la classe CRUD
require_once('classes/CRUD.php');

// Création d'une nouvelle instance de la classe CRUD
$crud = new CRUD;

// Tentative d'insertion des données du produit
$insert = $crud->insert('product', $_POST);

// Vérification si l'insertion a réussi
if ($insert) {
    // Redirection vers la page d'index après l'insertion réussie
    header('Location: index.php'); 
    exit(); // Fin du script après la redirection
} else {
    // Affichage d'un message d'erreur si l'insertion échoue
    echo "Error adding product.";
}
?>
