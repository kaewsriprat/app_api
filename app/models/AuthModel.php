<?php

class AuthModel extends Model
{

    public function check_credential($email, $password)
    {
        $sql = "SELECT id FROM users WHERE email = :email AND password = :password";
        $data = array(
            'email' => $email,
            'password' => $password,
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
