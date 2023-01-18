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

        $sql = "INSERT INTO user(name, size, is_available) VALUES (:name, :size,:is_available)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":name",$data["name"], PDO::PARAM_STR);
        $stmt->bindValue(":size",$data["size"] ?? 0, PDO::PARAM_INT);
        $stmt->bindValue(":is_available", (bool)$data["is_available"] ?? false, PDO::PARAM_BOOL);
        
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
}