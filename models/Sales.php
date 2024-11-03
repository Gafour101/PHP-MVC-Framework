<?php

namespace app\models;

use gaf\phpmvc\db\SalesModel;

class Sales extends SalesModel
{
    public int $id = 0;
    public int $customer_id = 0;
    public int $product_id = 0;
    public float $amount = 0.00;
    public float $quantity = 0.00;
    public string $receipt = '';
    public string $remarks = '';
    public string $created_at = '';
    public string $updated_at = '';

    // Implement specific functionalities and attributes for Sales
    public function tableName(): string
    {
        return 'sales'; // Replace with the actual table name for sales
    }

    public function attributes(): array
    {
        return ['customer_id', 'product_id', 'quantity', 'receipt', 'remarks','amount'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    // Implement validation rules for the attributes
    public function rules(): array
    {
        return [
            'customer_id' => [self::RULE_REQUIRED],
            'product_id' => [self::RULE_REQUIRED],
            'quantity' => [self::RULE_REQUIRED],
            'receipt' => [self::RULE_REQUIRED],
            'remarks' => [self::RULE_REQUIRED],
        ];
    }

    public function getCustomer()
    {
        $customer = new Customer();
        return $customer->findOne(['id' => $this->customer_id]);
    }

    public function getProduct()
    {
        $product = new Product();
        return $product->findOne(['id' => $this->product_id]);
    }
}
