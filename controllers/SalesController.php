<?php

namespace app\controllers;

use app\controllers\CustomerController;
use app\models\Product;
use app\models\Customer;
use app\models\Sales;
use gaf\phpmvc\Application;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;

class SalesController extends Controller
{

    public function index()
    {
        // Fetch all sales data
        $salesModel = new Sales();
        $salesData = $salesModel->findAll();

        // Render the dashboard view and pass data
        return $this->render('sales', [
            'sales' => $salesData,
        ]);
    }

    // Action to store the sales data from the add_sales form
    public function store(Request $request, Response $response)
    {
        // Check if the request is a POST request
        if ($request->isPost()) {
            // Get the form data from the request
            $formData = $request->getBody();

            // Validate the form data (you can add more validation as needed)
            if (empty($formData['customer']) || empty($formData['quantity']) || empty($formData['category']) || empty($formData['types'])) {
                // If any required fields are empty, redirect back with an error message
                Application::$app->session->setFlash('error', 'All fields are required.');
                return $response->redirect('/dashboard');
            }

            $customerId = $formData['customer'];

            if ($this->customerExist($customerId) === true) {
                $productModel = new Product();
                
                // Find the product ID from the Product model
                $productIdObject = $productModel->findItemByProductType($formData['category'], $formData['types']);

                // Ensure $productIdObject is not null and has the 'id' property
                if ($productIdObject && property_exists($productIdObject, 'id')) {
                    // Convert the 'id' property to an integer and assign it to the 'product_id' property
                    $productId = (int) $productIdObject->id;
                    
                    $salesModel = new Sales();
                    $salesModel->customer_id = $customerId;
                    $salesModel->product_id = $productId;
                    $salesModel->quantity = $formData['quantity'];
                    $salesModel->receipt = !empty($formData['receipt']) ? $formData['receipt'] : '';
                    $salesModel->remarks = !empty($formData['remarks']) ? $formData['remarks'] : '';
                    $salesModel->amount = $formData['amount'];

                    // Save the sales data to the database
                    if ($salesModel->save()) {
                        $new_sale = $salesModel->findLastSale();
                        return $response->json([
                            'message' => 'Successfully added new sale.',
                            'new_sale' => $new_sale,
                            'code' => 200,
                        ], 200); // This will send a JSON error message with a 404 status code
                    } else {
                        // If there was an error saving the data, redirect back with an error message
                        Application::$app->session->setFlash('error', 'Error occurred while saving sales data.');
                        return $response->redirect('/add_sale');
                    }
                } else {
                    // Handle the case when the product ID is not found or invalid
                    Application::$app->session->setFlash('error', 'Product not found.');
                    return $response->redirect('/dashboard');
                }
            }
        }
    }

    public function new(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $customerModel = new Customer();
            $formData = $request->getBody();

            $newCustomerId = $customerModel->findIdByName($formData['new_customer']);
            if ($newCustomerId === null) {
                $customerModel->fullname = $formData['new_customer'];
                $customerModel->contact = $formData['new_contact'];
                $customerModel->address = $formData['new_address'];

                if ($customerModel->save()) {
                    $customerId = $customerModel->findIdByName($formData['new_customer']);

                    $productModel = new Product();
                    $productIdObject = $productModel->findItemByProductType($formData['category'], $formData['types']);

                    if ($productIdObject && property_exists($productIdObject, 'id')) {
                        $productId = (int) $productIdObject->id;

                        $salesModel = new Sales();
                        $salesModel->customer_id = $customerId;
                        $salesModel->product_id = $productId;
                        $salesModel->quantity = $formData['quantity'];
                        $salesModel->receipt = !empty($formData['receipt']) ? $formData['receipt'] : '';
                        $salesModel->remarks = !empty($formData['remarks']) ? $formData['remarks'] : '';
                        $salesModel->amount = $formData['amount'];
                        
                        if ($salesModel->save()) {
                            $new_sale = $salesModel->findLastSale();
                            return $response->json([
                                'message' => 'Successfully added new customer and sale.',
                                'new_sale' => $new_sale,
                                'code' => 200,
                            ], 200);
                        } else {
                            return $response->json(['message' => 'Error occurred while saving sales data.'], 200);
                        }
                    } else {
                        return $response->json(['message' => 'Product not found'], 200);
                    }
                } else {
                    return $response->json(['message' => 'Error occurred while saving sales data.'], 200);
                }
            }
            else {
                return $response->json(['message' => 'Customer Already Exist.'], 200);
            }
        }
    }

    public function sales(Request $request, Response $response)
    {   
        if ($request->isAjax() && $request->isGet()) {
            $formData = $request->getBody();
            $salesModel = new Sales();

            $sales = $salesModel->findSales();

            return $response->json([
                'message' => 'Render Sales Today',
                'sales' => $sales,
                'code' => 200,
            ], 200);
        }
        //return $response->redirect('/dashboard');
    }

    public function details(Request $request, Response $response)
    {
        if ($request->isAjax() && $request->isGet()) {
            $saleData = $request->getBody()['id'];
            $salesId = (int) $saleData;

            $salesModel = new Sales();
            $sales = $salesModel->findSalesDetails($salesId);
            
            return $response->json([
                'message' => 'Render Sales Today',
                'sales' => $sales,
                'code' => 200,
            ], 200);
        }
    }

    public function total(Request $request, Response $response)
    {
        $salesModel = new Sales();
        $customerModel = new Customer();

        $totalSales = $salesModel->findTotalSales();
        $totalCustomers = $customerModel->findTotalCustomers();
        $totalSands = $salesModel->findTotalSalesByProduct('Sand');
        $totalGravels = $salesModel->findTotalSalesByProduct('Gravel');

        return $response->json([
                'message' => 'Render Total Infos',
                'totalSales' => $totalSales,
                'totalCustomers' => $totalCustomers,
                'totalSands' => $totalSands,
                'totalGravels' => $totalGravels,
                'code' => 200,
            ], 200);
    }

    
    private function customerExist(int $customerId)
    {   
        $customerModel = new Customer();
        return $customerModel->isfound($customerId);
    }

    public function sales_details(Request $request, Response $response)
    {   
        if ($request->isAjax() && $request->isGet()) {
            $salesId = $request->getBody()['id'];
            $id = (int) $salesId;

            $salesModel = new Sales();
            $productModel = new Product();

            $sales = $salesModel->findSalesDetails($id);

            $products = $productModel->findAll();
            $productTypes = [];

            // Store productTypes to array
            foreach ($products as $product) {
                $types = $product->findAllTypes($product->category);
                $productTypes[$product->category] = $types;
            }

            return $response->json([
                'message' => 'Render Sales Details Today',
                'sales' => $sales,
                'productTypes' => $productTypes,
                'code' => 200,
            ], 200);
        }
        return $response->redirect('/dashboard');        
    }

    public function edit(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $editData = $request->getBody();

            $salesModel = new Sales();
            $salesId = (int) $editData['id'];
            $sales = $salesModel->findOne($salesId);
            
            $editedCategory = $editData['category'];
            $editedTypes = $editData['types'];

            $productModel = new Product();
            $productIdObject = $productModel->findItemByProductType($editedCategory, $editedTypes);

            if ($productIdObject && property_exists($productIdObject, 'id')) {
                $productId = (int) $productIdObject->id;

                $sales->product_id = $productId;
                $sales->quantity = $editData['quantity'];
                $sales->receipt = $editData['receipt'];
                $sales->remarks = $editData['remarks'];

                if ($sales->update()) {
                    return $response->json([
                        'message' => 'Updated Successfully',
                        'code' => 200,
                    ], 200);
                }
                else {
                    return $response->json([
                        'message' => 'Failed to Update',
                        'code' => 500,
                    ], 200);
                }
            }
        }
    }

    public function destroy(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $deleteData = $request->getBody();
            $salesId = $deleteData['id'];
            
            $sales = new Sales();
            $sales->id = (int) $salesId;
            if ($sales->delete()) {
                return $response->json([
                    'message' => 'Deleted Successfully',
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Failed to Delete',
                    'code' => 500,
                ], 200);
            }
        }
    }

}
