<?php

class UsersModel extends Model
{
    public function get_users_data(){
        $sql = "SELECT users.id, users.prefix, users.firstname, users.lastname, users.email, divisions.division_abbr, users.active
                FROM users
                LEFT JOIN divisions
                ON users.division = divisions.id
                WHERE users.active = 1
                ";
        try {
            $stmt = $this->Rdb->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}
