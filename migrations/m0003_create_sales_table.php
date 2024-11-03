<?php
/** User: Gafour Tech ...**/


class m0003_create_sales_table {
    public function up()
    {
        $db = \gaf\phpmvc\Application::$app->db;
        $SQL = "CREATE TABLE sales (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_id INT NOT NULL,
            product_id INT NOT NULL,
            quantity DECIMAL(10, 2) NOT NULL,
            receipt VARCHAR(255) NOT NULL,
            remarks VARCHAR(255) NOT NULL,
            amount DECIMAL(10, 2) NOT NULL,
            sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \gaf\phpmvc\Application::$app->db;
        $SQL = "DROP TABLE sales;";
        $db->pdo->exec($SQL);
    }
}
