<?php

class User
{
    public function get_data($email){
        include("db.php");

        $query = $db->prepare("SELECT * FROM users WHERE Email='$email'");
        $query->execute();
        $control=$query->fetchAll(PDO::FETCH_OBJ);

        if(!empty($control)){
            return $control;
        }else{
            
        }
    }
}