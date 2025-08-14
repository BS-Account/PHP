<?php
  $db_user = 'php'; $db_pass = 'php_t35t!?'; $db_host = 'localhost'; $db_name = 'poc'; $Link = $_SERVER["QUERY_STRING"]; $status = ""; $msg = "";

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Fehler: " . $e->getMessage();
  }

  $data = json_decode(file_get_contents('php://input'));
  $abfrage_user = $pdo->query("SELECT * FROM users WHERE user = '$data[0]'");
  if($data[2] == 'create') {
    if($abfrage_user->rowCount() == 0 AND $data[0] != '' AND $data[1] != '') {
      $pw = password_hash($data[1], PASSWORD_DEFAULT);
      $pdo->query("INSERT INTO users (user, password, status, role, time_create, time_delete) VALUES ('$data[0]', '$pw', '-1', '1', '" . time() . "', '-1')");
      $status = 'success';
      $msg = 'Successfully created user ' . $data[0];
    } else {
      $status = 'error';
      $msg = 'Unable to create user';
    }
  } elseif($data[2] == 'check') {
    if($abfrage_user->rowCount() == 1) {
      while ($row_user = $abfrage_user->fetch(PDO::FETCH_ASSOC)) {
        if ($row_user['status'] == -1 && password_verify($data[1], $row_user['password'])) {
          $status = 'success';
          $msg = 'Successfully signed in user ' . $data[0];
        } else {
          $status = 'error';
          $msg = 'Incorrect password';
        }
      }
    } else {
      $status = 'error';
      $msg = 'Incorrect username';
    }
  } else {
    $status = 'error';
    $msg = 'Invalid instructions';
  }
  $awnser = array('status'=>$status, 'msg'=>$msg);
  echo json_encode($awnser);
?>