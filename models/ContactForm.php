<?php
/** User: Gafour Tech **/

namespace gaf\models;

use gaf\phpmvc\Model;

/**

    * Class gaflication
    *
    * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
    * @package gaf\models
    
**/
class ContactForm extends Model
{   
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Subject',
            'email' => 'Email',
            'body' => 'Body',
        ];
    }

    public function send()
    {
        return true;
    }
}