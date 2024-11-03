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
    
    public function update()
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $attributes = $this->attributes();

        // Prepare the SET part of the SQL query
        $set = implode(', ', array_map(fn($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("UPDATE $tableName SET $set WHERE $primaryKey = :$primaryKey");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->bindValue(":$primaryKey", $this->{$primaryKey});

        $statement->execute();
        return true;
    }

    public function updatePassword($newPassword)
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();

        $statement = self::prepare("UPDATE $tableName SET password = :password WHERE $primaryKey = :$primaryKey");
        $statement->bindValue(':password', $newPassword);
        $statement->bindValue(":$primaryKey", $this->{$primaryKey});

        $statement->execute();
        return true;
    }
}