<?php
/** User: Gafour Tech **/

namespace app\controllers;

use gaf\phpmvc\Application;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;
use app\models\User;
use app\models\LoginForm;
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
        $this->registerMiddleware(new AuthMiddleware(['profile']));
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

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {   
        
        return $this->render('profile');
    }
    public function dashboard()
    {   
        
        return $this->render('dashboard');
    }
}