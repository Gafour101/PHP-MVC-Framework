<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\ProductController;
use app\controllers\CustomerController;
use app\controllers\StockController;
use app\controllers\SalesController;
use app\controllers\DashboardController;
use gaf\phpmvc\Application;
use gaf\phpmvc\middlewares\AuthMiddleware;


require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Configuration array
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

// Create the application instance
$app = new Application(dirname(__DIR__), $config);

// Define routes and controllers
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);



$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/profile', [AuthController::class, 'profile']);


$app->router->get('/dashboard', [AuthController::class, 'index']);
$app->router->get('/inventory', [ProductController::class, 'index']);

// ================================  SALES   ================================ //
$app->router->post('/add_sale', [SalesController::class, 'store']);                     # add new sale by existing customer
$app->router->post('/new_customer_sale', [SalesController::class, 'new']);              # add new sale by new customer
$app->router->post('/update_sales_details', [SalesController::class, 'edit']);          # update sale
$app->router->post('/delete_sales', [SalesController::class, 'destroy']);               # delete sale
$app->router->get('/sales_today', [SalesController::class, 'sales']);                   # fetch sales data to table
$app->router->get('/sales_info', [SalesController::class, 'total']);                    # fetch total sales to pills
$app->router->get('/sales_details', [SalesController::class, 'details']);               # fetch total sales to pills
$app->router->get('/edit_sales_details', [SalesController::class, 'sales_details']);    # fetch total sales to pills           

// ================================  CUSTOMERS   ================================ //
$app->router->get('/customers', [CustomerController::class, 'index']);                          # fetch sales data to table
$app->router->get('/customer_details', [CustomerController::class, 'customer_details']);
$app->router->get('/edit_customer_details', [CustomerController::class, 'customer_details']);
$app->router->post('/add_customer', [CustomerController::class, 'store']);
$app->router->post('/update_customer_details', [CustomerController::class, 'edit']);
$app->router->post('/delete_customer', [CustomerController::class, 'destroy']);
// ================================  STOCKS   ================================ //
$app->router->get('/stocks', [StockController::class, 'stocks']);             # fetch stocks data to pills
$app->router->get('/stocks_info', [StockController::class, 'index']);         # fetch stocks data to table
$app->router->post('/add_stock', [StockController::class, 'update']);         # add stock by selected category


$app->router->post('/store_products', [ProductController::class, 'store']);
$app->router->post('/update_products', [ProductController::class, 'edit']);
$app->router->post('/delete_products', [ProductController::class, 'destroy']);
$app->router->get('/find_product', [ProductController::class, 'find']);
$app->router->get('/sands', [ProductController::class, 'sands']);
$app->router->get('/gravels', [ProductController::class, 'gravels']);

$app->router->get('/fetch_user', [AuthController::class, 'fetchUser']);
$app->router->post('/update_user', [AuthController::class, 'updateProfile']);
$app->router->post('/update_pass', [AuthController::class, 'changePassword']);

// $app->router->get('/dashboard/products/(:any)', [DashboardController::class, 'findTypesByProduct'])->name('dashboard.products'); // <-- Move the name() call here

// Add other dashboard routes here...


// Run the application
$app->run();
