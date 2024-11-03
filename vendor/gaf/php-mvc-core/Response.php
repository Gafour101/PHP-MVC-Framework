<?php
/** User: Gafour Tech ...**/

namespace gaf\phpmvc;

/**

    * Class Application
    *
    * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
    * @package gaf\phpmvc
    
**/

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url, int $statusCode = 302)
    {
        // Set the "Location" header to perform the redirection
        header('Location: ' . $url, true, $statusCode);

        // Terminate the script execution immediately after sending the header
        exit;
    }


    public function json(array $data, int $statusCode = 200)
    {
        $this->setStatusCode($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}