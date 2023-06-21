<?php
include("friends.php");
include("db.php");


$postId = $_POST['input'];

$query = $db->prepare("SELECT * from posts WHERE postId='$postId' ");
$query->execute();
$control=$query->fetchAll(PDO::FETCH_OBJ);
$control = json_decode(json_encode($control), true);
$control = $control[0];

$like = $control["Heart"] + 1;

$query = $db->prepare("UPDATE posts SET Heart=$like where postId='$postId'");
$query->execute();


$query = $db->prepare("INSERT into likedpost (Email, postId) values ('$youremail', '$postId')");
$query->execute();