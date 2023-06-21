<?php



class Signup
{
    


    public function evaluate($data)
    {
        include("db.php");
        $error = "";
        foreach ($data as $key => $value) {

            if($key != 'lemail' && $key != 'lpass'){

                if(empty($value))
                {
                    $error = $error . $key . " is empty!<br>"; 
                }

                if($key == "email"){
                    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)){
                        $error .= "Wrong " . $key . " format!<br>";
                    }
                    $query = $db->prepare("SELECT * FROM users WHERE Email = '$value'");
                    $query->execute();
                    $control = $query->fetchAll(PDO::FETCH_OBJ);
                    $control = json_decode(json_encode($control), true);
                    $control = $control;

                    if(!empty($control)){
                        $error .= "This email is already used!<br>";
                    }
                }
                if($key == "pass"){
                    if(!preg_match("/[0-9a-zA-Z]{4,}/", $value)){
                        $error .= "You must enter at least 4 character for a " . $key . "word<br>";
                    }
                }
            }
            
        }
        if($data["pass"] != $data["passr"]){
            $error .= "You should enter the same password.";
        }



        if ($error == "")
        {
            $this->create_user($data);
        }




        else
        {
            return $error;
        }
    }

    public function create_user($data)
    {
        include("db.php");

        $name = $data["name"];
        $surname = $data["surname"];
        $email = $data["email"];
        $bd = $data["bd"];
        $pass = $data["pass"];
        $pp = $data["pp"];

        $hashed = password_hash($pass, PASSWORD_BCRYPT);


        $query = "insert into users (Name,Surname,Email,Birthday,Password,ProfilePicture)
        values
        ('$name','$surname','$email','$bd','$hashed','$pp')";
        
        echo "<div style='text-align: center; font-size: 12px; color: white; background-color: green;'>";
        echo "You can sign in now :)";
        echo "</div>";
        
        $db->query($query);
    }
}