<?php
/** User: Gafour Tech ...**/

namespace gaf\phpmvc\db;

use gaf\phpmvc\db\DbModel;
/**

    * Class Application
    *
    * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
    * @package gaf\phpmvc\db
    
**/

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}