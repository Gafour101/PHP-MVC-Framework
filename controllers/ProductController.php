<?php

namespace app\controllers;

use app\models\Product;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;
use gaf\phpmvc\middlewares\AuthMiddleware; // Import the AuthMiddleware class
class ProductController extends Controller
{   
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['index']));
    }
    public function index()
    {
        $productModel = new Product();

        // Get all products of Sand and Gravel
        $products = $productModel->findAll();
        
        // Render the dashboard view with products data 
        return $this->render('inventory', [
            'products' => $products,
        ]);
    }

    public function store(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $formData = $request->getBody();

            $products = new Product();
            $products->category = $formData['category'];
            $products->types = $formData['types'];  
            $products->created_at = date('Y-m-d H:i:s');
            $products->updated_at = date('Y-m-d H:i:s');   
            
            if ($products->save()) {
                return $response->json([
                    'message' => 'Product Added Successfully',
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Product Added Failed',
                    'code' => 500,
                ], 500);
            }
        }
    }

    public function edit(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $formData = $request->getBody();

            $productId = (int) $formData['id'];
            $productCategory = $formData['category'];
            $productTypes = $formData['types'];
            $date = date('Y-m-d H:i:s');

            $productModel = new Product();
            $product = $productModel->findOne($productId);
            $product->id = $productId;
            $product->types = $productTypes;
            $product->updated_at = $date;

            if ($product->update()) {
                return $response->json([
                    'message' => 'Product Updated Successfully',
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Product Updated Failed',
                    'code' => 500,
                ], 500);
            }
        }
    }

    public function destroy(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $formData = $request->getBody();

            $productId = (int) $formData['id'];

            $productModel = new Product();
            $product = $productModel->findOne($productId);

            if ($product->delete()) {
                return $response->json([
                    'message' => 'Product Deleted Successfully',
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Product Deleted Failed',
                    'code' => 500,
                ], 500);
            }
        }
    }

    public function sands(Request $request, Response $response)
    {   
        if ($request->isGet()) {
            $productModel = new Product();
            
            // Get all types of Sand
            $sands = $productModel->findSands();
            $gravels = $productModel->findGravels();

            // Render the dashboard view with products data 
            if ($sands) {
                return $response->json([
                    'message' => 'Sands Types',
                    'sands' => $sands,
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Sands Types',
                    'sands' => $sands,
                    'code' => 200,
                ], 200);
            }
        }
    }

    public function gravels(Request $request, Response $response)
    {   
        if ($request->isGet()) {
            $productModel = new Product();
            
            $gravels = $productModel->findGravels();

            // Render the dashboard view with products data 
            if ($gravels) {
                return $response->json([
                    'message' => 'Gravel Types',
                    'gravels' => $gravels,
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Sands Types',
                    'gravels' => $gravels,
                    'code' => 200,
                ], 200);
            }
        }
    }

    public function find(Request $request, Response $response)
    {
        if ($request->isGet()) {
            $formData = $request->getBody();
            $productId = (int) $formData['id'];

            $productModel =  new Product();
            $product = $productModel->findOne($productId);
            
            if($product)
            {
                return $response->json([
                    'message' => 'Product Found',
                    'product' => $product,
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Product Not Found',
                    'code' => 200,
                ], 200);
            }
        }
    }

}
