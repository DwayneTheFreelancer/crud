<?php

// Database Connection
function connectDB() {
    try {
        $database = new PDO("mysql:host=127.0.0.1;dbname=crud;port=8889","root","root");
        $database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        echo "<h4 style='color: green'>Connected to Database</h4>";
        return $database;
    } catch(Exception $e) {
        echo "Unable to connect to database";
        echo "<h4 style='color: red'>" . $e->getMessage() . "</h4>";
        exit;
    }
}

$pdo = connectDB();

function initMigration($pdo) {
    try {
        $statement = $pdo->prepare(
            "CREATE TABLE IF NOT EXISTS users (
                id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                first_name varchar(255) NOT NULL,
                last_name varchar(255) NOT NULL,
                age int NOT NULL
            );"
        );
        $statement->execute();
    } catch(Exception $e) {
        echo "<h4 style='color: red'>" . $e->getMessage() . "</h4>";
    }
}