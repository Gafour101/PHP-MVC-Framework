<?php

// app/models/Customer.php

namespace app\models;

use gaf\phpmvc\db\Model;
use gaf\phpmvc\db\CustomerModel;

class Customer extends CustomerModel
{   
    public int $id = 0;
    public string $fullname = '';
    public string $contact = '';
    public string $address = '';

    // Implement validation rules for the attributes
    public function rules(): array
    {
        return [
            'fullname' => [self::RULE_REQUIRED],
            'contact' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
        ];
    }

    // Implement specific functionalities and attributes for Customers
    public function tableName(): string
    {
        return 'customers'; // Replace with the actual table name for customers
    }

    public function attributes(): array
    {
        return ['fullname', 'contact' , 'address'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function getNameColumn(): string
    {
        return 'fullname';
    }

    public function getContactColumn(): string
    {
        return 'contact';
    }

    public function getAddressColumn(): string
    {
        return 'address';
    }

    
}
