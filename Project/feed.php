<?php
    // $SALT="_CTIS_SALT_12345";
    // $secret_key=bin2hex(random_bytes(10));
    // $csrf_token=password_hash($secret_key.$SALT);
    // password_verify($secret_key.$SALT,$csrf_token);


    session_start();
  

    include("db.php");
    include("classes/login.php");
    include("classes/user.php");

    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        $user = new User();

        $user_data = $user->get_data($email);
        
        
        $array = json_decode(json_encode($user_data), true);
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
        <h1 id="name"> <a href="profile.php"><?php echo $array[0]["Name"]; ?> <img style="width: 75px; border-radius:360px;" src="./img/pp/<?php echo $array[0]["ProfilePicture"] ?>" alt=""></a></h1>
        <h1 id="logout"><a href="index.php">LogOut</a></h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div id="newpost">
            <input type="file" name="postimg" id="inputfile"><br>
            <input type="text" name="postcaption" placeholder="Caption" id="inputcaption">
            <button name='postit'>Post it</button>
        </div>
    </form>
    <div id="container">
    <?php
        $query = $db->prepare("SELECT * FROM friends WHERE Email = '$email'");
        $query->execute();
        $control=$query->fetchAll(PDO::FETCH_OBJ);
        $friends = json_decode(json_encode($control), true);
        
        $friendpost = [];
        for ($i=0;$i<count($friends); $i++) {
            $friendemail = $friends[$i]['Femail'];
            $query = $db->prepare("SELECT * FROM posts WHERE Email = '$friendemail'");
            $query->execute();
            $control = $query->fetchAll(PDO::FETCH_OBJ);
            if(!empty($control)){
                array_push($friendpost, json_decode(json_encode($control), true));
            }
            
            
        }
        
        
        
        if(!empty($friendpost)){
            $cnt=0;
            for($i = 0; $i < count($friendpost); $i++){
                for($j=0;$j<count($friendpost[$i]); $j++){
                
                    $postid = $friendpost[$i][$j]['postId'];

                $query = $db->prepare("SELECT * FROM likedpost WHERE Email = '$youremail' AND postId='$postid'");
                $query->execute();
                $control2 = $query->fetchAll(PDO::FETCH_OBJ);
                $control2 = json_decode(json_encode($control2), true);
                
                $friendemail = $friendpost[$i][$j]['Email'];

                $query = $db->prepare("SELECT * FROM users WHERE Email = '$friendemail'");
                $query->execute();
                $control3 = $query->fetchAll(PDO::FETCH_OBJ);
                $control3 = json_decode(json_encode($control3), true);
                $control3 = $control3[0];
                

                
                echo "<div id='feed'>";
                //caption
                echo $control3["Name"];
                echo " ";
                echo $control3["Surname"];
                echo " says: ";
                echo $friendpost[$i][$j]['Caption'];
                //img
                echo "<img src='Uploadedimg/";
                echo $friendpost[$i][$j]['Img'];
                echo "' style='width: 694px; height: 500px;'>";
                //like and comment
                if(empty($control2)){
                    echo "<a data-liker='$youremail' data-target='$postid' href='?' class='heart' >&#9825;</a>";
                }else{
                    echo "<a data-liker='$youremail' data-target='$postid' href='?' class='disheart' >&#9829;</a>";
                }
                echo $friendpost[$i][$j]['Heart'];
                echo "<br> Comments: <br>";
                echo $friendpost[$i][$j]['Comment'];
                echo "<form method='POST'>";
                echo "<br>";
                echo "<input type='text' class='commenttext' name='commenttext' placeholder='Write a comment...'><input data-commenter='$youremail' data-target='$postid' type='submit' class='comment' value='&#10148;'>";
                echo "</div>";
                echo "</form>";
                $cnt = $cnt+1;
                }             
                
            }
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

        $(".heart").click(function(e){
            e.preventDefault();
            var input = $(this).data('target');
            var liker = $(this).data('liker');
            $.ajax({
                url: 'likePost.php',
                method: 'POST',
                data: {
                    input: input,
                    liker: liker
                },
                success: function(response){
                    
                }
            });
        })

        $(".disheart").click(function(e){
            e.preventDefault();
            var input = $(this).data('target');
            var liker = $(this).data('liker');
            $.ajax({
                url: 'disheart.php',
                method: 'POST',
                data: {
                    input: input,
                    liker: liker
                },
                success: function(response){
                    
                }
            });
        })

        $(".comment").click(function(e){
            e.preventDefault();
            if($(".commenttext").val() != ""){
                var input = $(this).data('target');
                var commenttext = $(".commenttext").val();
                var commenter = $(this).data('commenter');
                $.ajax({
                url: 'sendComment.php',
                method: 'POST',
                data: {
                    commenttext: commenttext,
                    input: input,
                    commenter: commenter
                },
                success: function(response){
                    
                },
                error: function(xhr, status, error){
                    
                }
            });
            }
        })

    </script>
</body>
</html>