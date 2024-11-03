<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Sales;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;

class CustomerController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $customer = new Customer();
        $customers = $customer->findAll();

        return $response->json([
            'message' => 'Fetch Customers Data',
            'customers' => $customers,
            'code' => 200,
        ], 200);

    }

    public function store(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $formData = $request->getBody();

            $customer = new Customer();
            $customer->fullname = $formData['fullname'];
            $customer->contact = $formData['contact'];
            $customer->address = $formData['address'];

            if ($customer->save()) {
                return $response->json([
                    'message' => 'Added Successfully',
                    'code' => 200,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Failed to Add',
                    'code' => 500,
                ], 200);
            }
        }
    }

    public function edit(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $editData = $request->getBody();

            $customer = new Customer();
            $customerId = $editData['id'];
            $customer->id = (int) $customerId;
            $customer->fullname = $editData['fullname'];
            $customer->contact = $editData['contact'];
            $customer->address = $editData['address'];
            
            if ($customer->update()) {
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

    public function destroy(Request $request, Response $response)
    {
        if ($request->isPost()) {
            $deleteData = $request->getBody();
            $customerId = $deleteData['id'];
            
            $customer = new Customer();
            $customer->id = (int) $customerId;
            if ($customer->delete()) {
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

    public function customers(Request $request, Response $response)
    {
        $salesModel = new Sales();
        $sand = 'Sand';
        $gravel = 'Gravel';

        $customersModel = new Customer();
        $customersList = $customersModel->findAll();

        $customerSandInfo = [];
        $customerGravelInfo = [];
        foreach ($customersList as $customer) {
            $customersSandInfo = $salesModel->findCustomerSale($customer->id, $sand);
            $customersGravelInfo = $salesModel->findCustomerSale($customer->id, $gravel);
        }

        var_dump($customerSandInfo);
        var_dump($customerGravelInfo);

        return $request->json([
            'message' => 'Wew',
            'customerSandInfo' => $customerSandInfo,
            'customerGravelInfo' => $customerGravelInfo,
            'code' => 200,
        ], 200);
    }

    public function customer_details(Request $request, Response $response)
    {
        $customerId = $request->getBody()['id'];
        $id = (int) $customerId;

        // Fetch the customer from the database
        $customerModel = new Customer();
        $customer = $customerModel->findOne($id);

        // Return the customer details as a view or JSON response
        
        return $response->json([
            'message' => 'Customer Details',
            'customer' => $customer,
            'code' => 200,
        ], 200);
    }
}
