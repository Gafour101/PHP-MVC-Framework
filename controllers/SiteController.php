<?php
/** User: Gafour Tech **/

namespace app\controllers;

use gaf\phpmvc\Application;
use gaf\phpmvc\Controller;
use gaf\phpmvc\Request;
use gaf\phpmvc\Response;
use app\models\ContactForm;
/**

    * Class Application
    *
    * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
    * @package app\controllers
    
**/

class SiteController extends Controller
{   
    public function home(Request $request, Response $response)
    {   
        $params = [
            'name' => "Gafour Gwapo"
        ];
        return $response->redirect('/login');
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us!  ');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}