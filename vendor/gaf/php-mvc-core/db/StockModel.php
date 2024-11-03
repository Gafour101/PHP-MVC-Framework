<?php

namespace gaf\phpmvc\db;

use gaf\phpmvc\Model;
use PDO;

abstract class StockModel extends DbModel
{
    // Define the table name for the sales
    abstract public function tableName(): string;

    // Define the attributes for the sales table
    abstract public function attributes(): array;

    // Define the primary key for the sales table
    abstract public function primaryKey(): string;

    // Save the sale into the database
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

    // Find a sale by its primary key
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

    // Find all sales
    public function findAll()
    {
        $tableName = $this->tableName();

        $sql = "SELECT * FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function findSands()
    {
        $tableName = $this->tableName();
        $sandColumn = $this->getProductColumn();
        $quantityColumn = $this->getQuantityColumn();
        
        $sand = 'Sand';

        $sql = "SELECT $quantityColumn FROM $tableName WHERE $sandColumn = :sand LIMIT 1";
        $statement = self::prepare($sql);
        $statement->bindValue(':sand', $sand);

        $statement->execute();
        return $statement->fetchColumn();
    }

    public function findGravels()
    {
        $tableName = $this->tableName();
        $gravelColumn = $this->getProductColumn();
        $quantityColumn = $this->getQuantityColumn();


        $gravel = 'Gravel';

        $sql = "SELECT $quantityColumn FROM $tableName WHERE $gravelColumn = :gravel LIMIT 1";
        $statement = self::prepare($sql);
        $statement->bindValue(':gravel', $gravel);

        $statement->execute();
        return $statement->fetchColumn();
    }

    
    // Update the sale in the database
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

    // Delete the sale from the database
    public function delete()
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();

        $sql = "DELETE FROM $tableName WHERE $primaryKey = :primaryKeyValue";
        $statement = self::prepare($sql);
        $statement->bindValue(':primaryKeyValue', $this->{$primaryKey}, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function findTotalStocks()
    {
        $tableName = $this->tableName();

        $sql = "SELECT SUM(quantity) AS total FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function findTotalProduct($category)
    {
        $tableName = $this->tableName();
        $categoryColumn = $this->getProductColumn();

        $sql = "SELECT quantity AS total FROM $tableName WHERE $categoryColumn = :category";
        $statement = self::prepare($sql);
        $statement->bindValue(':category', $category);
        $statement->execute();
        
        return $statement->fetchColumn();
    }

    public function findStockByCategory($category)
    {
        $tableName = $this->tableName();
        $categoryColumn = $this->getProductColumn();

        $sql = "SELECT * FROM $tableName WHERE $categoryColumn = :category";
        $statement = self::prepare($sql);
        $statement->bindValue(':category', $category);
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

}
