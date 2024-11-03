<?php

namespace gaf\phpmvc\db;

use gaf\phpmvc\Model;
use PDO;

abstract class SalesModel extends DbModel
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

    // Find sales by product type
    public function findByProductType(string $productType)
    {
        $tableName = $this->tableName();

        $sql = "SELECT * FROM $tableName WHERE product_type = :productType";
        $statement = self::prepare($sql);
        $statement->bindValue(':productType', $productType, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    // Find total sales by product type
    public function findTotalSalesByProduct(string $productType)
    {
        $tableName = $this->tableName();
        $categoryColumn = "category";

        $sql = "SELECT sales.id as id, products.category FROM sales JOIN products ON sales.product_id = products.id WHERE products.category = :productType;";
        $statement = self::prepare($sql);
        $statement->bindValue(':productType', $productType, PDO::PARAM_STR);
        $statement->execute();

        return $statement->rowCount();
    }

    public function findSales()
    {
        $sql = "SELECT sales.id AS id, customers.fullname, customers.contact, customers.address, products.category, products.types, sales.customer_id, sales.product_id, sales.quantity, sales.receipt, sales.remarks, sales.amount ,sales.sale_date 
        FROM sales JOIN customers ON sales.customer_id = customers.id JOIN products ON sales.product_id = products.id ORDER BY sales.sale_date DESC;";

        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function findSalesDetails($primaryKeyValue)
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();

        $sql = "SELECT sales.id AS id, customers.fullname, customers.contact, customers.address, products.category, products.types, sales.customer_id, sales.product_id, sales.quantity, sales.receipt, sales.remarks,sales.amount, sales.sale_date 
        FROM $tableName JOIN customers ON sales.customer_id = customers.id JOIN products ON sales.product_id = products.id WHERE sales.id = :primaryKeyValue;";
        $statement = self::prepare($sql);
        $statement->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function findLastSale()
    {
        $sql = "SELECT sales.id AS id, customers.fullname, customers.contact, customers.address, products.category, products.types, sales.customer_id, sales.product_id, sales.quantity, sales.receipt, sales.remarks,sales.amount, sales.sale_date 
            FROM sales 
            JOIN customers ON sales.customer_id = customers.id 
            JOIN products ON sales.product_id = products.id
            ORDER BY sales.sale_date DESC
            LIMIT 1;";

        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public function findTotalSales()
    {
        $tableName = $this->tableName();

        $sql = "SELECT * FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->rowCount();
    }

    public function findCustomerSales($customer_id, $category)
    {
        $tableName = $this->tableName();
        $sql = "SELECT sales.id AS id, products.category, sales.customer_id, customers.fullname , FROM $tableName 
                JOIN customers ON sales.customer_id = customers.id 
                JOIN products ON sales.product_id = products.id
                WHERE sales.customer_id = :customer_id AND products.category = :category ORDER BY sales.sale_date;";
        $statement->bindValue(':customer_id', $customer_id, PDO::PARAM_INT);
        $statement->bindValue(':category', $category, PDO::PARAM_STR);
        $statement->execute();

        return $statement->rowCount();
    }
}
