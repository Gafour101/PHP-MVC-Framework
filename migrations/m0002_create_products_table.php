<?php
/** User: Gafour Tech ...**/


class m0002_create_products_table {
    public function up()
    {
        $db = \gaf\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                category VARCHAR(255) NOT NULL,
                types VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \gaf\php\Application::$app->db;
        $SQL = "DROP TABLE users;";
        $db->pdo->exec($SQL);
    }
}