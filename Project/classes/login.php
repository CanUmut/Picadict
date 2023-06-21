<?php

class Login
{

    


    public function evaluate($data)
    {
        $error = "";

        include("db.php");

        $email = $data["lemail"];
        $pass = $data["lpass"];

        foreach ($data as $key => $value) {

                if(empty($value) && $key == "lemail")
                {
                    $error = $error . "Email is empty!<br>"; 
                }

                if(empty($value) && $key == "lpass")
                {
                    $error = $error . "Password is empty!<br>"; 
                }

                
            
            
        }
        if ($error == "")
        {
            

            $query = $db->prepare("SELECT Password FROM users WHERE Email='$email'");
            // $query = $db->prepare("SELECT Password FROM users WHERE Email='$email' AND Password='$pass'");
            $query->execute();
            $control=$query->fetchAll(PDO::FETCH_OBJ);
            $control = json_decode(json_encode($control), true);
            

            if(password_verify($pass, $control[0]['Password'])){
                $_SESSION["email"]=$email;
                header("Location:feed.php");
            }
            // if(!empty($control)){
            //     $_SESSION["email"]=$email;
            //     header("Location:feed.php");
            // }
            else {
                echo "<div style='text-align: center; font-size: 12px; color: white; background-color: green;'>";
                echo "Incorrect Password or Email!";
                echo "</div>";
            }
        }



        else
        {
            return $error;
        }
    }

    
}