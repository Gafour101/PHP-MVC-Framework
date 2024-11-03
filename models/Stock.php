<?php

namespace app\models;

use gaf\phpmvc\db\StockModel;

class Stock extends StockModel
{   
    public string $category = '';
    public float $quantity = 0.00;

    // Implement specific functionalities and attributes for Products
    public function tableName(): string
    {
        return 'stocks'; // Replace with the actual table name for products
    }

    public function attributes(): array
    {
        return ['category', 'quantity', 'updated_at']; 
    }

    public function primaryKey(): string
    {
        return 'id'; 
    }

    public function getProductColumn(): string
    {
        return 'category'; 
    }
    
    public function getQuantityColumn(): string
    {
        return 'quantity'; 
    }

    // Implement validation rules for the attributes
    public function rules(): array
    {
        return [
            'category' => [self::RULE_REQUIRED],
            'quantity' => [self::RULE_REQUIRED],
        ];
    }
}