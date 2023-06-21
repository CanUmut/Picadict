<?php

    session_start();

    include("db.php");
    include("classes/login.php");
    include("classes/user.php");

    if(isset($_SESSION["email"])){
        //user data
        $email = $_SESSION["email"];
        $user = new User();
        $user_data = $user->get_data($email);
        $array = json_decode(json_encode($user_data), true);
        //all user data
        $query = $db->prepare("SELECT * FROM users");
        $query->execute();
        $control=$query->fetchAll(PDO::FETCH_OBJ);
        $allArray = json_decode(json_encode($control), true);

        $youremail = $array[0]['Email'];

    }

    
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postit'])){
        include("Upload.php");
        $post = new Upload("postimg", "Uploadedimg");
        
        // $postimg = $_POST['postimg'];
        $postcaption = $_POST['postcaption'];
        if(false){
            echo "<div style='text-align: center; font-size: 12px; color: white; background-color: green;'>";
            echo "Image and/or caption is empty!";
            echo "</div>";
        }else{
            $postId = $email . $post->filename;
            $query =$db->prepare("INSERT into posts (postId, Email, Img, Comment, Heart, Caption)
                                    values ('$postId', '$email', '$post->filename', '', '', '$postcaption')");
            $query->execute();
        }
        
    }
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        if(empty($_POST['inp'])){
            echo "<div style='text-align: center; font-size: 12px; color: white; background-color: green;'>";
            echo "Search bar is empty!";
            echo "</div>";
        }else{
            $everyone = [];
            $inp = $_POST['inp'];
            $inp = strtolower($inp);

            foreach ($allArray as $people) {
                $str = $people['Name'].$people['Surname'].$people['Email'];
                $str = strtolower($str);
                if(str_contains($str, $inp)){
                    array_push($everyone, $people);
                }
            }
        }
    }
    // elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addf'])){
    //     if(empty($_POST['targetemail'])){
    //         echo "<div style='text-align: center; font-size: 12px; color: white; background-color: green;'>";
    //         echo "You need to write an Email to add!";
    //         echo "</div>";
    //     }else{
    //         $targetemail = $_POST['targetemail'];
    //         $emailsender = $array[0]['Email'];
    //         if($emailsender == $targetemail){
    //             echo "<div style='text-align: center; font-size: 12px; color: white; background-color: green;'>";
    //             echo "You can't send a friend request to yourself :D";
    //             echo "</div>";
    //         }else{
    //             $query = "INSERT into notification (Email, NotiFrom) values ('$targetemail', '$emailsender')";
    //             $db->query($query);
    //             echo "<div style='text-align: center; font-size: 12px; color: white; background-color: green;'>";
    //             echo "You successfully send a request";
    //             echo "</div>";
    //         }
            
    //     }
    // }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <link rel="stylesheet" href="picadict.css">
    <style>
        #container{
            display:flex;
        }
        #add{
            font-size:25px;
        }
    </style>
</head>
<body>
    <div id="menu">
        <img src="./img/PicDic.png" width="150px" height="150px">
        <h1><a href="feed.php">Home</a></h1>
        <h1><a href="friends.php">Friends</a></h1>
        <h1 id="btn">New Post</h1>
        <h1 id="name"> <a href="profile.php"><?php echo $array[0]["Name"]; ?> <img style="width: 75px; border-radius:360px;" src="./img/pp/<?php echo $array[0]["ProfilePicture"] ?>" alt=""></a></h1>
        <h1 id="logout"><a href="index.php">LogOut</a></h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div id="newpost">
            <input type="file" name="postimg" id=""><br>
            <input type="text" name="postcaption" placeholder="Caption" id="">
            <button name="postit" class='postit'>Post it</button>
        </div>
    </form>
    
        <div id="container">
            <div id="friends">
                <form action="" method="post">
                <h2>Current Friends: <br></h2>
                    <?php
                    $query = $db->prepare("SELECT * FROM friends WHERE Email = '$email'");
                    $query->execute();
                    $control=$query->fetchAll(PDO::FETCH_OBJ);
                    $friends = json_decode(json_encode($control), true);

                    $friendinfo = [];

                    foreach ($friends as $friend) {
                        $friendemail = $friend['Femail'];
                        $query = $db->prepare("SELECT * FROM users WHERE Email = '$friendemail'");
                        $query->execute();
                        $control = $query->fetchAll(PDO::FETCH_OBJ);
                        array_push($friendinfo, json_decode(json_encode($control), true));
                    }
                    

                    for($i=0; $i<count($friendinfo); $i++){
                        $fremail = $friendinfo[$i][0]['Email'];
                        echo "<img style='width: 75px; border-radius:360px;' src='./img/pp/";
                        echo $friendinfo[$i][0]['ProfilePicture'];
                        echo "'>";
                        echo $friendinfo[$i][0]['Name'];
                        echo " ";
                        echo $friendinfo[$i][0]['Surname'];
                        echo " ";
                        echo "<input data-target='$fremail' type='submit' value='&#128465;' class='deletefriend' style=' color:red; font-size: 25px;'>";
                        echo "<br>";
                        echo $friendinfo[$i][0]['Email'];
                        echo "<br>";
                    }
                    ?>
                </form>
                
            </div>
            <div id="add">
                <form action="" method="post">
                    <input type="text" name="inp" id="search" placeholder="Search People">
                    <input type="submit" value="&#128269;" name="search">
                </form>
                <form action="" method="POST">
                <?php
                    if(empty($everyone)){
                        echo "No one is found!";
                    }else{
                        for($i = 0; $i < count($everyone); $i++){
                            $targetemail = $everyone[$i]['Email'];
                            echo "<img style='width: 75px; border-radius:360px;' src='./img/pp/";
                            echo $everyone[$i]['ProfilePicture'];
                            echo "'>";
                            echo $everyone[$i]['Name'];
                            echo " ";
                            echo $everyone[$i]['Surname'];
                            echo " <input data-target='$targetemail' type='submit' value='&#10133;' class='addf' style='width: 100px; background-color: aqua;'>";
                            echo "<br>";
                            echo "<p>";
                            echo $everyone[$i]['Email'];
                            echo "</p>";
                            echo "<br>";
                        }
                    }
                ?>
                </form>
            </div>
        </div>
        <div id="notification">
            <h1>Notifications: </h1>
            <form action="" method="post">
            <?php
            $query = $db->prepare("SELECT * FROM notification where Email='$youremail'");
            $query->execute();
            $control=$query->fetchAll(PDO::FETCH_OBJ);
            $notarray = json_decode(json_encode($control), true);
            for ($i = 0; $i < count($notarray); $i++) {
                $notiFrom = $notarray[$i]['NotiFrom'];

                echo $notarray[$i]['NotiFrom'];
                echo " wants to be your friend!";
                echo "<input data-target='$notiFrom' type='submit' value='&#10004' class='acceptBtn' name='accept'>";
                echo "<input data-target='$notiFrom' type='submit' value='&#120;' class='declineBtn' name='decline'>";
                echo "<br>";
            }
            ?>

            </form>
            
        </div>
    
    <script>
        
        var showed = 0;
        $("#btn").click(function () {
            if(showed == 1){
                $("#newpost").hide();
                showed = 0;
            }else{
                $("#newpost").show();
                showed = 1;
            }
        });


        $(document).on('click', '.acceptBtn', function(){
            var input = $(this).data('target');
            $.ajax({
                url: 'AcceptNoti.php',
                method: 'POST',
                data: {
                    input: input
                },
                success: function(response){
                    
                }
            });
        });
        $(document).on('click', '.declineBtn', function(){
            var input = $(this).data('target');
            $.ajax({
                url: 'DeclineNoti.php',
                method: 'POST',
                data: {
                    input: input
                },
                success: function(response){
                    
                }
            });
        });

        $(document).on('click', '.deletefriend', function(){
            var input = $(this).data('target');
            $.ajax({
                url: 'deleteFriend.php',
                method: 'POST',
                data: {
                    input: input
                },
                success: function(response){
                    
                }
            });
        });

        $(document).on('click', '.addf', function(){
            var input = $(this).data('target');
            $.ajax({
                url: 'sendNoti.php',
                method: 'POST',
                data: {
                    input: input
                },
                success: function(response){
                    
                }
            });
        })
    </script>
    
</body>
</html>