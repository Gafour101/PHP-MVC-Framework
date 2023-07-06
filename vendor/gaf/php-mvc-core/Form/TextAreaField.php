<?php
/** User: Gafour Tech **/

namespace gaf\phpmvc\form;

use gaf\phpmvc\Model;
/**

    * Class Field
    *
    * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
    * @package gaf\phpmvc\form
    
**/

class TextAreaField extends BaseField
{   
    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s bg-transparent myborder myborder-radius p-2">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid ' : '',
            $this->model->{$this->attribute},
        );
    }
       
}
