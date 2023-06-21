<?php

    session_start();

    include("db.php");
    include("classes/login.php");
    include("classes/user.php");

    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        $user = new User();

        $user_data = $user->get_data($email);
        
        
        $array = json_decode(json_encode($user_data), true);
        

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
    
</head>
<body>
    <div id="menu">
        <img src="./img/PicDic.png" width="150px" height="150px">
        <h1><a href="feed.php">Home</a></h1>
        <h1><a href="friends.php">Friends</a></h1>
        <h1 id="btn">New Post</h1>
        <h1 id="name"><?php echo $array[0]["Name"]; ?> <img style="width: 75px; border-radius:360px;" src="./img/pp/<?php echo $array[0]["ProfilePicture"] ?>" alt=""></h1>
        <h1 id="logout"><a href="index.php">LogOut</a></h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div id="newpost">
            <input type="file" name="postimg" id=""><br>
            <input type="text" name="postcaption" placeholder="Caption" id="">
            <button name='postit'>Post it</button>
        </div>
    </form>
    <div id="container">
        <?php
        $query = $db->prepare("SELECT * FROM posts WHERE Email = '$email'");
        $query->execute();
        $control=$query->fetchAll(PDO::FETCH_OBJ);
        $postarray = json_decode(json_encode($control), true);
        
        
        foreach ($postarray as $photo) {
            echo "<div id='feed'>";
            //caption
            echo $array[0]["Name"];
            echo " says: ";
            echo $photo['Caption'];
            //img
            echo "<img src='Uploadedimg/";
            echo $photo['Img'];
            echo "' style='width: 694px; height: 500px;'>";
            //like and comment
            echo "Like: ";
            echo $photo['Heart'];
            echo "<br> Comments: <br>";
            echo $photo['Comment'];
            echo "<br>";
            echo "</div>";
        }
        ?>
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
            
            
        })
    </script>
</body>
</html>