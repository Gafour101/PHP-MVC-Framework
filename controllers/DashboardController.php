<?php

namespace app\controllers;

use gaf\phpmvc\Application;
use app\models\Sales;
use app\models\Product;
use app\models\Customer;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;
use gaf\phpmvc\middlewares\AuthMiddleware;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Apply AuthMiddleware to secure the dashboard
        $this->registerMiddleware(new AuthController(['index']));
    }

    public function index()
    {   
        echo "DashboardController index method is called"; // Debug message
        // Get data from the database securely
        $productModel = new Product();
        $customerModel = new Customer();
        $salesModel = new Sales();

        // Get all data
        $products = $productModel->findAll();
        $customers = $customerModel->findAll();
        $sales = $salesModel->findAll();

        echo array(var_dump($products));
        
        return $this->render('dashboard', [
            'products' => $products,
            'customers' => $customers,
            'sales' => $sales,
        ]);
    }

    public function findTypesByProduct(Request $request, Response $response)
    {
        // Get data from the database securely
        $productModel = new Product();

        $productTypes = $productModel->findAllTypes($category);

        return $this->render('dashboard', [
            'productTypes' => $productTypes,
        ]);
    }
}
