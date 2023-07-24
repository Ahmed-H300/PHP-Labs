<?php

class DatabaseConnection
{
    public $db;

    // Constructor: Establishes the database connection
    public function __construct($dns, $user, $pass)
    {
        try {
            $this->db = new PDO($dns, $user, $pass);
            // Set PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Not Connected: ' . $e->getMessage();
            exit;
        }
    }

    // Destructor: Closes the database connection
    public function __destruct()
    {
        $this->db = null;
    }

}

