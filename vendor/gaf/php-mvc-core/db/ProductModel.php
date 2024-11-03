<?php

namespace gaf\phpmvc\db;

use gaf\phpmvc\db\DbModel;
use gaf\phpmvc\Application;
use gaf\phpmvc\Model;
use PDO;
/**

    * Class Application
    *
    * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
    * @package gaf\phpmvc\db
    
**/


abstract class ProductModel extends DbModel
{

    abstract public function getProductColumn(): string;
    abstract public function getTypeColumn(): string;


    // Save the product into the database
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $columns = implode(',', $attributes);
        $placeholders = implode(',', array_map(fn($attr) => ":$attr", $attributes));
        
        $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";

        $statement = self::prepare($sql);

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        return $statement->execute();
    }

    // Find a product by its primary key
    public function findOne($primaryKeyValue)
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();

        $sql = "SELECT * FROM $tableName WHERE $primaryKey = :primaryKeyValue";
        $statement = self::prepare($sql);
        $statement->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    // Find all products
    public function findAllProducts()
    {
        $tableName = $this->tableName();
        $productColumn = $this->getProductColumn();

        // Create an array of product names you want to retrieve
        $products = ['Sand', 'Gravel'];

        // Create placeholders for the products list to be used in the SQL query
        $placeholders = implode(', ', array_fill(0, count($products), '?'));

        $sql = "SELECT $productColumn FROM $tableName WHERE $productColumn IN ($placeholders)";
        $statement = self::prepare($sql);

        // Bind each product value to the corresponding placeholder
        foreach ($products as $index => $product) {
            $statement->bindValue($index + 1, $product, PDO::PARAM_STR);
        }

        $statement->execute();

        // Fetch the results as an array
        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    // Find all types of product/category
    public function findAllTypes($productName)
    {
        $tableName = $this->tableName();
        $productColumn = $this->getProductColumn();
        $typesColumn = $this->getTypeColumn();

        // SELECT types FROM products WHERE $category = :productName
        $sql = "SELECT $typesColumn FROM $tableName WHERE $productColumn = :productName";
        $statement = self::prepare($sql);
        $statement->bindValue(':productName', $productName, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function findItemByProductType(string $category, string $types)
    {
        $tableName = $this->tableName();
        $categoryColumn = $this->getProductColumn();
        $typesColumn = $this->getTypeColumn();
        $primaryKey = $this->primaryKey();
        
        $sql = "SELECT $primaryKey FROM $tableName WHERE $categoryColumn = :category AND $typesColumn = :types LIMIT 1";
        $statement = self::prepare($sql);
        $statement->bindValue(':category', $category, PDO::PARAM_STR);
        $statement->bindValue(':types', $types, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchObject(static::class);
    }


    // Find all products
    public function findAll()
    {
        $tableName = $this->tableName();

        $sql = "SELECT * FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    // Update the product in the database
    public function update()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $primaryKey = $this->primaryKey();

        $columns = implode(', ', array_map(fn($attr) => "$attr = :$attr", $attributes));

        $sql = "UPDATE $tableName SET $columns WHERE $primaryKey = :$primaryKey";

        $statement = self::prepare($sql);

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->bindValue(":$primaryKey", $this->{$primaryKey}, PDO::PARAM_INT);

        return $statement->execute();
    }

    // Delete the product from the database
    public function delete()
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();

        $sql = "DELETE FROM $tableName WHERE $primaryKey = :primaryKeyValue";
        $statement = self::prepare($sql);
        $statement->bindValue(':primaryKeyValue', $this->{$primaryKey}, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function findSands()
    {
        $tableName = $this->tableName();
        $tableName = $this->tableName();
        $productColumn = $this->getProductColumn();
        $productName = 'Sand';

        // SELECT types FROM products WHERE $category = :productName
        $sql = "SELECT * FROM $tableName WHERE $productColumn = :productName";
        $statement = self::prepare($sql);
        $statement->bindValue(':productName', $productName, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function findGravels()
    {
        $tableName = $this->tableName();
        $tableName = $this->tableName();
        $productColumn = $this->getProductColumn();
        $productName = 'Gravel';

        // SELECT types FROM products WHERE $category = :productName
        $sql = "SELECT * FROM $tableName WHERE $productColumn = :productName";
        $statement = self::prepare($sql);
        $statement->bindValue(':productName', $productName, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }
}
