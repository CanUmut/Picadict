<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PicaDict</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body{
            background-image: url(./img/bg4.png);
            background-size: 100%;
            font-size: large;
        }
        h1{
            text-align: center;
            font-size: 100px;
            
        }
        #logo{
            width: 420px;
            height: 420px;
        }
        #container{
            display: flex;
            justify-content: right;
            margin-top: 50px;
            margin-left: 150px;
            margin-right: 300px;
        }
        #register{
            display: none;
            text-align: right;
            color: white;
            border: 10px solid white;
        }
        #login{
            display: none;
            text-align: right;
            color: white;
            border: 10px solid white;
        }
        #home{
            display: flex;
            justify-content: space-around;
            
        }
        #signup{
            width: 200px;
            height: 60px;
            margin-right: 100px;
            font-weight: bold;
            background-image: url(./img/signup.png);
            background-size: 100%;
            background-color: rgb(0, 0, 72);
            border: 5px solid blue;
            
        }
        #signin{
            width: 200px;
            height: 60px;
            margin-left: 100px;
            font-weight: bold;
            background-image: url(./img/signin.png);
            background-size: 100%;
            background-color: rgb(0, 0, 72);
            border: 5px solid blue;
        }
        #signup:hover{
            background-color: rgb(242, 0, 255);
            border: 10px solid rgb(0, 0, 51);
        }
        #signin:hover{
            background-color: rgb(242, 0, 255);
            border: 10px solid rgb(0, 0, 51);
        }
        #register input{
            width: 130px;
            padding: 10px;
        }
        #login input{
            width: 130px;
            padding: 10px;
        }
        .sb{
            background-color: greenyellow;
        }
    </style>
    
</head>
<body>
    
    
    <form action="" method="post">
        <h1><img id="logo" src="./img/PicDic.png" alt=""></h1>
    <div id="home">
        <a href="sign.php"><input type="button" id="signup" value=""></a>
            
            <a href="log.php"><input type="button" id="signin" value=""></a>
            
    </div>
    
    <div id="container">
        <div id="register">
            Name: <input type="text" name="name" id="name">Password: <input type="password" name="pass" id="pass"><br>
            Surname: <input type="text" name="surname" id="surname">Password Again: <input type="password" name="passr" id="passr"><br>
            Email: <input type="text" name="email" id="email">Profile Picture: <input type="file" name="pp" id="pp"><br>
            Birth Date: <input type="date" name="bd" id="bd"><input class="sb" type="submit" value="Continue" id="upbutton"><br>
            
            
            
            
        </div>
        <div id="login">
            Email: <input value='<?php echo $email ?>' type="text" name="lemail" id="lemail"><br>
            Password: <input type="password" name="lpass" id="lpass"><br>
            <input type="submit" value="Continue" class="sb" id="inbutton">
        </div>
    </div>
    </form>    


    <script>
        $("#signin").click(function(){

        })
        $("#signup").click(function(){
            $("#register").show();
            $("#login").hide();
            $("#container").css("justify-content", "left");
        })
    </script>
</body>
</html>