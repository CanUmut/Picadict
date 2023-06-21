<?php

include("db.php");


$postId = $_POST['input'];
$commenttext = $_POST['commenttext'];
$commenter = $_POST['commenter'];

$query = $db->prepare("SELECT * FROM posts WHERE postId='$postId'");
$query->execute();
$control=$query->fetchAll(PDO::FETCH_OBJ);
$control = json_decode(json_encode($control), true);

$old = $control[0]['Comment'];

$commenttext = $old . $commenter . " : " . $commenttext . "<br>";

$query = $db->prepare("UPDATE posts SET Comment = '$commenttext' where postId= '$postId'");
$query->execute();
?>
