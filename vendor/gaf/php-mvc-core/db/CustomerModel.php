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


abstract class CustomerModel extends DbModel
{

    abstract public function getNameColumn(): string;
    abstract public function getContactColumn(): string;
    abstract public function getAddressColumn(): string;


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

        return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    /**
     * Find the ID of a customer by their name.
     *
     * @param string $customer The name of the customer.
     * @return int|null The ID of the customer, or null if not found.
     */
    public function findIdByName($customer)
    {
        // Get the name of the table
        $tableName = $this->tableName();

        // Get the primary key column name
        $primaryKey = $this->primaryKey();

        // Get the column name for the customer's full name
        $fullnameColumn = $this->getNameColumn();

        // Prepare the SQL statement to select the primary key column for the given customer name
        $sql = "SELECT $primaryKey FROM $tableName WHERE $fullnameColumn = :customer";

        // Prepare the statement and bind the customer name parameter
        $statement = self::prepare($sql);
        $statement->bindValue(':customer', $customer, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();

        // Fetch the first row of the result as an associative array
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // If a row was found, return the ID as an integer
        if ($result) {
            return (int) $result[$primaryKey];
        }

        // If no row was found, return null
        return null;
    }

    // Find all customers
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

    public function findAllNames()
    {
        $tableName = $this->tableName();
        $columnName = $this->getNameColumn();

        $sql = "SELECT $columnName FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    // Find a customer's contact by its primary key
    public function findContact($primaryKeyValue)
    {
        $tableName = $this->tableName();
        $fullnameColumn = $this->getNameColumn();
        $primaryKey = $this->primaryKey();

        $sql = "SELECT $fullname FROM $tableName WHERE $primaryKey = :primaryKeyValue";
        $statement = self::prepare($sql);
        $statement->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    // Find a customer's contact by its primary key
    public function findAddress($primaryKeyValue)
    {
        $tableName = $this->tableName();
        $fullnameColumn = $this->getNameColumn();
        $primaryKey = $this->primaryKey();

        $sql = "SELECT $fullname FROM $tableName WHERE $primaryKey = :primaryKeyValue";
        $statement = self::prepare($sql);
        $statement->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchObject(static::class);
    }

    public function findTotalCustomers()
    {
        $tableName = $this->tableName();

        $sql = "SELECT * FROM $tableName";
        $statement = self::prepare($sql);
        $statement->execute();

        return $statement->rowCount();
    }

    public function isfound($primaryKeyValue)
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $sql = "SELECT $primaryKey FROM $tableName WHERE $primaryKey = :primaryKeyValue";
        
        $statement = self::prepare($sql);
        $statement->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_STR);
        
        $result = $statement->execute();
        
        // If a row was found, return the ID as an integer
        return $result && $statement->rowCount() > 0;
    }


}
