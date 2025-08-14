<?php

  $db_user = 'php';
  $db_pass = 'php_t35t!?';
  $db_host = 'localhost';
  $db_name = 'poc';
  $Link = $_SERVER["QUERY_STRING"];

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Fehler: " . $e->getMessage();
  }
  $ot_token = bin2hex(random_bytes(32));
  $pdo->query("INSERT INTO tokens (token, status) VALUES('$ot_token', 1)");
  echo "http://172.26.0.5/info.php?$ot_token";