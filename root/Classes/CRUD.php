<?php

// Définition de la classe CRUD qui étend PDO pour interagir avec la base de données
class CRUD extends PDO {
    // Constructeur de la classe, établissant la connexion avec la base de données
    public function __construct() {
        // Connexion à la base de données "gestion_produits" avec PDO
        parent::__construct('mysql:host=localhost; dbname=gestion_produits; port=3308; charset=utf8', 'root', 'dolfin98');
    }

    // Méthode pour récupérer tous les enregistrements d'une table, triés par un champ spécifié
    public function select($table, $field = 'id', $order = 'ASC') {
        // Requête SQL pour sélectionner tous les enregistrements d'une table
        $sql = "SELECT * FROM $table ORDER BY $field $order";
        // Exécution de la requête
        $stmt = $this->query($sql);
        // Retourne les résultats sous forme de tableau
        return $stmt->fetchAll();
    }

    // Méthode pour sélectionner un enregistrement d'une table basé sur un champ spécifique (par exemple, l'ID)
    public function selectId($table, $value, $field = 'id') {
        // Requête SQL pour sélectionner un enregistrement par un champ spécifique
        $sql = "SELECT * FROM $table WHERE $field = :$field";
        // Préparation de la requête
        $stmt = $this->prepare($sql);
        // Liaison de la valeur au paramètre
        $stmt->bindValue(":$field", $value);
        // Exécution de la requête
        $stmt->execute();
        // Retourne le résultat si un enregistrement est trouvé, sinon false
        return $stmt->rowCount() == 1 ? $stmt->fetch() : false;
    }

    // Méthode pour insérer un nouvel enregistrement dans une table
    public function insert($table, $data) {
        // Création de la liste des noms de champs et des valeurs
        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":" . implode(', :', array_keys($data));
        // Requête SQL pour insérer des données dans la table
        $sql = "INSERT INTO $table ($fieldName) VALUES ($fieldValue)";
        // Préparation de la requête
        $stmt = $this->prepare($sql);
        // Liaison des valeurs aux paramètres
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        // Exécution de la requête
        $stmt->execute();
        // Retourne l'ID du dernier enregistrement inséré
        return $this->lastInsertId();
    }

    // Méthode pour mettre à jour un enregistrement dans une table
    public function update($table, $data, $field = "id") {
        // Création de la liste des champs à mettre à jour
        $fieldName = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
        // Requête SQL pour mettre à jour un enregistrement
        $sql = "UPDATE $table SET $fieldName WHERE $field = :$field";
        // Préparation de la requête
        $stmt = $this->prepare($sql);
        // Liaison des valeurs aux paramètres
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        // Exécution de la requête et retourne si elle a réussi
        return $stmt->execute();
    }

    // Méthode pour supprimer un enregistrement dans une table
    public function delete($table, $value, $field = 'id') {
        // Requête SQL pour supprimer un enregistrement basé sur un champ spécifique
        $sql = "DELETE FROM $table WHERE $field = :$field";
        // Préparation de la requête
        $stmt = $this->prepare($sql);
        // Liaison de la valeur au paramètre
        $stmt->bindValue(":$field", $value);
        // Exécution de la requête et retourne si la suppression a réussi
        return $stmt->execute();
    }
}

?>
