<?php

namespace app\controllers;

use app\models\Stock;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;

class StockController extends Controller
{   
    public function index(Request $request, Response $response)
    {
        $stockModel = new Stock();
        $stocks = $stockModel->findAll() ;
        $sands = $stockModel->findSands();
        $gravels = $stockModel->findGravels();
        return $response->json([
            'message' => 'Successfully rendered.',
            'stocks' => $stocks,
            'sands' => $sands,
            'gravels' => $gravels,
            'code' => 200,
        ], 200);
    }

    public function update(Request $request, Response $response)
    {
        if($request->isAjax() && $request->isPost())
        {
            $formData = $request->getBody();
            $addCategory = (int) $formData['category'];
            $addQuantity = (double) $formData['quantity'];
            
            $stockModel = new Stock();
            $stock = $stockModel->findOne($addCategory); ;
            
            $prevQuantity = (double) $stock->quantity;
            $newQuantity = $prevQuantity + $addQuantity;
            
            $stock->quantity = $newQuantity;
            $stock->updated_at = date('Y-m-d H:i:s');

            if ($stock->update()) {
                $updatedStock = $stock;
                return $response->json([
                    'message' => 'Successfully updated.',
                    'stock' => $stock,
                    'code' => 200,
                ], 200);
            }
        }
    }

    public function stocks(Request $request, Response $response)
    {
        if ($request->isGet()) {
            $stockModel = new Stock();
            $stock = $stockModel->findTotalStocks();
            $sand = $stockModel->findTotalProduct('Sand');
            $gravel = $stockModel->findTotalProduct('Gravel');

            $code = (int) 200;
            return $response->json([
                'message' => 'Successfully rendered.',
                'stock' => $stock,
                'sand' => $sand,
                'gravel' => $gravel,
            ], $code);
        }
    }

}
