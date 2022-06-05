<?php
    function getDatabaseConnection(){

        $host = 'localhost';
        $dbname = 'testdb';
        $user = 'root';
        $password = '';
        $dsn = "mysql:dbname=$dbname; host=$host";
        
        try {
            $conn = new PDO($dsn, $user, $password);
            return $conn;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    function insertData($first_name, $last_name, $email) {
        
        $conn = getDatabaseConnection();

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email) VALUES (:first_name, :last_name, :email)");

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);

        // $stmt->execute(array(':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email));

        $respose = $stmt->execute();

        if ($respose)
        {
            return $conn->lastInsertId();
        }
        else
        {
            return FALSE;
        }
    }

    function getAllData() {

        $conn = getDatabaseConnection();

        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
?>