<?php
/** User: Gafour Tech **/

namespace app\controllers;

use gaf\phpmvc\Application;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;
use app\models\User;
use app\models\LoginForm;
use app\models\Product;
use app\models\Customer;
use app\models\Sales;
use gaf\phpmvc\middlewares\AuthMiddleware; // Import the AuthMiddleware class
/**

    * Class Application
    *
    * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
    * @package app\controllers
    
**/

class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['index'],['profile'],['dashboard']));
    }

    public function index()
    {
        // Get data from the database securely
        $productModel = new Product();
        $customerModel = new Customer();
        $salesModel = new Sales();

        // Get all products data
        $products = $productModel->findAll();

        $productTypes = [];

         // Store productTypes to array
        foreach ($products as $product) {
            $types = $product->findAllTypes($product->category);
            $productTypes[$product->category] = $types;
        }

        $customers = $customerModel->findAll();
        $customerNameList = $customerModel->findAllNames();

        $sales = $salesModel->findAll();
        // $salesToday = $salesModel->findSalesToday();

        //var_dump($salesToday);

        return $this->render('dashboard', [
            'products' => $products,
            'customers' => $customers,
            'productTypes' => $productTypes,
            'customerNameList' => $customerNameList,
            'sales' => $sales,
        ]); 
    }

    
    public function findTypesByProduct(Request $request, Response $response, string $category)
    {
        // Get data from the database securely
        $productModel = new Product();

        $productTypes = $productModel->findAllTypes($category);

        return $this->render('dashboard', [
            'productTypes' => $productTypes,
        ]);
    }


    public function login(Request $request, Response $response)
    {   
        $loginForm = new LoginForm();
        
        if($request->isPost()){
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/dashboard');
                return; 
            }
        }

        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function updateProfile(Request $request, Response $response)
    {
        
        if ($request->isPost()) {
            $formData = $request->getBody();
            $id = $formData['id'];

            $user = Application::$app->user;

            $fname = $formData['firstname'];
            $lname = $formData['lastname'];
            $email = $formData['email'];

            $user->firstname = $fname;
            $user->lastname = $lname;
            $user->email = $email;
            if ($user->update()) {
                return $response->json([
                    'message' => 'Updated Successfully.',
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'email' => $user->email,
                ], 200);
            }
            else {
                return $response->json([
                    'message' => 'Failed to updated.',
                ], 500);
            }
        }

        return $this->render('profile', [
            'model' => $user,
        ]);
    }

    public function changePassword(Request $request, Response $response)
    {
        $user = Application::$app->user;
        if ($user === null) {
            // User is not logged in
            $response->redirect('/login');
            return;
        }

        if ($request->isPost()) {
            $formData = $request->getBody();
            $oldPassword = $formData['old_password'];
            $newPassword = $formData['new_password'];
            $confirmPassword = $formData['confirm_new_password'];

            // Verify old password
            if (!password_verify($oldPassword, $user->password)) {
                return $response->json([
                    'message' => 'Old password is incorrect.',
                ], 200);
            }

            // Validate new password
            if ($newPassword !== $confirmPassword) {
                return $response->json([
                    'message' => 'New password do not match',
                ], 200);
            }
            // Hash and update the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            if ($user->updatePassword($hashedPassword)) {
                return $response->json([
                    'message' => 'Password Updated Successfully.',
                ], 200);
            }
        }
       
    }


    public function register(Request $request)
    {   
        $user = new User();
        if($request->isPost())
        {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'You have been registered!');
                Application::$app->response->redirect('/login');
                exit;
            }
           
           
            return $this->render('register', [
                'model' => $user
            ]);
        }

        $this->setLayout('auth');
        return $this->render('register', [
                'model' => $user
        ]);
    }

    public function fetchUser(Request $request, Response $response)
    {
        $user = Application::$app->user;

        if ($user === null) {
            // User is not logged in
            return $response->json([
                'message' => 'User not logged in',
            ], 401);
        }

        return $response->json([
            'id' => $user->id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/login');
    }

    public function profile()
    {   
        return $this->render('profile');
    }
    public function dashboard()
    {   
        return $this->render('index');
    }
}