<?php
/** User: Gafour Tech ...**/


class m0003_create_stocks_table {
    public function up()
    {
        $db = \gaf\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE stocks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            category VARCHAR(255) NOT NULL,
            quantity DECIMAL(10, 2) NOT NULL,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);

        // Insert data into the stocks table
        $insertSQL = "INSERT INTO stocks (category, quantity) VALUES
                      ('Sand', 1.0),
                      ('Gravel', 1.0);";
        $db->pdo->exec($insertSQL);
    }

    public function down()
    {
        $db = \gaf\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE sales;";
        $db->pdo->exec($SQL);
    }
}
