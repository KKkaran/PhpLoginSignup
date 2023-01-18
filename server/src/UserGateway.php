<?php
//this file will be fetching records from the db
class UserGateway{

    private PDO $conn;
    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }
    public function getAllUsers():array{
        $sql = "SELECT * 
                FROM user";
        $stmt = $this->conn->query($sql);
        $data = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }
    public function getUserById(string $id):array{
        $sql = "SELECT * 
                FROM user 
                WHERE id = $id";
        $stmt = $this->conn->query($sql);
        $data = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }
    public function create(array $data):string{

        $hashedPasswd = password_hash($data["password"],PASSWORD_DEFAULT);
        $sql = "INSERT INTO user(email,name, password) VALUES (:email, :name,:password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":email",$data["email"], PDO::PARAM_STR);
        $stmt->bindValue(":name",$data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":password", $hashedPasswd, PDO::PARAM_STR);
        
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
}