<?php
    $dsn = "mysql:host=localhost;dbname=picadict;charset=utf8mb4" ;
    $user = "root" ;
    $pass = "" ;
    try {
       $db = new PDO($dsn, $user, $pass) ;
    } catch(PDOException $e) {
      echo json_encode(["error" => "API Server is down due to DB Connection"]);
      exit ;
    }

    