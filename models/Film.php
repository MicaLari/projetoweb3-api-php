<?php
class Film {
    
    private $id;
    private $name;
    private $img;
    private $genero;
    private $min;

    function __construct($id, $name, $img, $genero, $min) {
        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
        $this->genero = $genero;
        $this->min = $min;
    }

    function create(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("INSERT INTO user (name, email, pass, avatar)
            VALUES (:name, :email, :pass, :avatar)");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':img', $this->img);
            $stmt->bindParam(':genero', $this->genero);
            $stmt->bindParam(':min', $this->min);
            $stmt->execute();
            $id = $conn->lastInsertId();
            $conn = null;
            return $id;
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function list(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("SELECT * FROM film");
            $stmt->execute();
            $cadastro = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            return $cadastro;
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function getById(){
        $conn = Database::connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM film WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            return $user;
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function delete(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("DELETE FROM film WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            $conn = null;
            if($rowsAffected){
                return true;
            } else {
                return false;
            }
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

    function update(){
        $conn = Database::connect();
        
        try{
            $stmt = $conn->prepare("UPDATE film SET name = :name, img = :img, genero = :genero, min = :min WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':img', $this->img);
            $stmt->bindParam(':genero', $this->genero);
            $stmt->bindParam(':min', $this->min);
            $stmt->execute();
            $rowsAffected = $stmt->rowCount();
            if($rowsAffected){
                return true;
            } else {
                return false;
            }
        }catch(PDOException $e) {
            Database::dbError($e);
        }
    }

}

?>