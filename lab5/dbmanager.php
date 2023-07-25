<?php

// no one can access it
include('config.php');

include('db.php');

class dbManager
{
    private $dbConn;

    public function __construct($dns, $user, $pass)
    {
        $this->dbConn = new DatabaseConnection($dns, $user, $pass);
    }

    // insert in any signle table
    public function insertData($table,$user,$coldata)
    {
        try {
            $sql = "INSERT INTO $table(";
            foreach ($coldata as $key => $value) {
                $sql .= "$value,";
            }
            $sql = substr($sql,0,-1);
            $sql .= ") VALUES(";
            foreach ($coldata as $key => $value) {
                $sql .= ":$value,";
            }
            $sql = substr($sql,0,-1);
            $sql .= ");";
            $stmt = $this->dbConn->db->prepare($sql);
            foreach ($user as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    
    // select in any signle table
    public function selectData($table)
    {
        try {
            $sql = 'SELECT * FROM ' . $table;
            $stmt = $this->dbConn->db->prepare($sql);
            $result = $stmt->execute();
            if (!$result) {
                return false;
            }
            // Fetch all rows as associative array
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (Exception $e) {
            return false;
        }
    }
    
    // update in any signle table
    public function updateData($table,$user,$coldata, $id)
    {
        try {
            $sql = "UPDATE $table SET ";
            foreach ($coldata as $key => $value) {
                $sql .= "$value = :$value,";
            }
            $sql = substr($sql,0,-1);
            $sql .= " WHERE `id` = :userId;";
            $stmt = $this->dbConn->db->prepare($sql);
            foreach ($user as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(":userId", $id);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
    // delte in any single table
    public function deleteData($table, $id)
    {
        try {
            $sql = "DELETE FROM $table WHERE id = ?";
            $stmt = $this->dbConn->db->prepare($sql);
            $stmt->bindParam(1, $id);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getUser($id)
    {
        try {
            $sql = 'SELECT * FROM users WHERE id = ?';
            $stmt = $this->dbConn->db->prepare($sql);
            $stmt->bindParam(1, $id);
            $result = $stmt->execute();
            if (!$result) {
                return false;
            }
            // Fetch row as associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllUsers()
    {
        try {
            $sql = 'SELECT * FROM users';
            $stmt = $this->dbConn->db->prepare($sql);
            $result = $stmt->execute();
            if (!$result) {
                return false;
            }
            // Fetch all rows as associative array
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (Exception $e) {
            return false;
        }
    }


    public function delUser($id)
    {
        try {
            $sql = 'DELETE FROM users WHERE id = ?';
            $stmt = $this->dbConn->db->prepare($sql);
            $stmt->bindParam(1, $id);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function insertUser($user)
    {
        try {
            $sql = 'INSERT INTO users(`fname`,`lname`,`email`,`Address`,`country`,`gender`,`skill`,`username`,`password`,`dep`,`room`,`image`) VALUES(:fname,:lname,:email,:Address,:country,:gender,:skill,:username,:password,:dep,:room,:image)';
            $stmt = $this->dbConn->db->prepare($sql);
            foreach ($user as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function updateUser($id, $user)
    {
        try {
            $sql = 'UPDATE users 
                SET `fname` = :fname,
                    `lname` = :lname,
                    `email` = :email,
                    `Address` = :Address,
                    `country` = :country,
                    `gender` = :gender,
                    `skill` = :skill,
                    `username` = :username,
                    `password` = :password,
                    `dep` = :dep,
                    `room` = :room,
                    `image` = :image
                WHERE `id` = :userId';

            $stmt = $this->dbConn->db->prepare($sql);
            foreach ($user as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->bindValue(":userId", $id);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    // to check user name and password
    public function selectUserbyusernameandpassword($userName, $password){
        try {
            $sql = 'SELECT * FROM users WHERE username = ? and password = ?';
            $stmt = $this->dbConn->db->prepare($sql);
            $stmt->bindParam(1, $userName);
            $stmt->bindParam(2, $password);
            $result = $stmt->execute();
            if (!$result) {
                return false;
            }
            // Fetch row as associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (Exception $e) {
            return false;
        }

    }

    // checkifusernameexist
    public function checkifusernameexist($userName){
        try {
            $sql = 'SELECT * FROM users WHERE username = ?';
            $stmt = $this->dbConn->db->prepare($sql);
            $stmt->bindParam(1, $userName);
            $result = $stmt->execute();
            if (!$result) {
                return false;
            }
            // Fetch row as associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (Exception $e) {
            return false;
        }

    }
    
}

// Create Instance
$dbManager = new dbManager($dns, $user, $pass);

// var_dump($dbManager->selectData('users'));
// $data = array();
// $coldata = ["fname","lname","email","Address","country","gender","skill","username","password","dep","room","image"];
// $data["fname"] = 'H';
// $data["lname"] = 'F';
// $data["email"] = 'sadf@wear.com';
// $data["Address"] = null;
// $data["country"] = 'egypt';
// $data["gender"] = 'male';
// $data["skill"] = '["PHP","JS","MySQL","PostgreSQL"]';
// $data["username"] = 'ahmed_hany705007';
// $data["password"] = 'bae5e3208a3c700e3db642b6631e95b9';
// $data["dep"] = 'OS';
// $data["room"] = 'application1';
// $data["image"] = 'images/1690132310.jpg';
// var_dump($dbManager->insertData('users',$data,$coldata));
// var_dump($dbManager->selectData('users'));
// $data = array();
// $coldata = ["fname","lname","email","Address","country","gender","skill","username","password","dep","room","image"];
// $data["fname"] = 'Hany';
// $data["lname"] = 'F';
// $data["email"] = 'sadf@wear.com';
// $data["Address"] = null;
// $data["country"] = 'egypt';
// $data["gender"] = 'male';
// $data["skill"] = '["PHP","JS","MySQL","PostgreSQL"]';
// $data["username"] = 'ahmed_hany705007';
// $data["password"] = 'bae5e3208a3c700e3db642b6631e95b9';
// $data["dep"] = 'OS';
// $data["room"] = 'application1';
// $data["image"] = 'images/1690132310.jpg';
// var_dump($dbManager->updateData('users',$data,$coldata,28));
// var_dump($dbManager->selectData('users',28));
// var_dump($dbManager->deleteData('users',28));
// var_dump($dbManager->selectData('users'));



