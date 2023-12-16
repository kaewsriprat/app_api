<?php

class UsersModel extends Model
{

    public function new_user($fullname, $email, $password)
    {
        if($this->if_user_exists($email)){
            return false;
        }
        
        $sql = "INSERT INTO users (fullname, email, password) VALUES (:fullname, :email, :password)";
        $data = array(
            'fullname' => $fullname,
            'email' => $email,
            'password' => $password,
        );

        try{
            $stmt = $this->Wdb->prepare($sql);
            $this->bind($stmt, $data);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function if_user_exists($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $data = array(
            'email' => $email,
        );

        try{
            $stmt = $this->Rdb->prepare($sql);
            $this->bind($stmt, $data);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            return false;
        }
    }

    public function get_user_by_id($id) {
        $sql = "SELECT id, fullname, email, active, last_login, created_date, updated_date FROM users WHERE id = :id";
        $data = array(
            'id' => $id,
        );

        try{
            $stmt = $this->Rdb->prepare($sql);
            $this->bind($stmt, $data);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result) {
                return $result;
            } else {
                return false;
            }
        } catch(PDOException $e) {

            return false;
        }
    }
}
