<?php
include("friends.php");
include("db.php");


$em = $_POST['input'];

$sql = "delete from friends where Email = ? AND Femail = ?";
$query = $db->prepare($sql);
$query->execute([$youremail, $em]);

$sql = "delete from friends where Email = ? AND Femail = ?";
$query = $db->prepare($sql);
$query->execute([$em, $youremail]);