<?php

namespace app\models;

use gaf\phpmvc\db\ProductModel;

class Product extends ProductModel
{   
    public string $category = '';
    public string $types = '';

    // Implement specific functionalities and attributes for Products
    public function tableName(): string
    {
        return 'products'; // Replace with the actual table name for products
    }

    public function attributes(): array
    {
        return ['category', 'types', 'created_at', 'updated_at']; 
    }

    public function primaryKey(): string
    {
        return 'id'; 
    }

    public function getProductColumn(): string
    {
        return 'category'; 
    }
    
    public function getTypeColumn(): string
    {
        return 'types'; 
    }

    // Implement validation rules for the attributes
    public function rules(): array
    {
        return [
            'category' => [self::RULE_REQUIRED],
            'types' => [self::RULE_REQUIRED],
        ];
    }
}