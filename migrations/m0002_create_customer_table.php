<?php
/** User: Gafour Tech ...**/


class m0002_create_customer_table {
    public function up()
    {
        $db = \gaf\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE customers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                fullname VARCHAR(255) NOT NULL,
                contact VARCHAR(255) NOT NULL,
                address VARCHAR(255) NOT NULL,
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