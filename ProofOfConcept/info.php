<?php
  session_start();
  $db_user = 'php';
  $db_pass = 'php_t35t!?';
  $db_host = 'localhost';
  $db_name = 'poc';
  $Link = $_SERVER["QUERY_STRING"];
  $arre = array('1' => 'Nein');

  $_SESSION['Location'] = 'sign_in.php';

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo "Fehler: " . $e->getMessage();
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Site Name</title>
  </head>
  <body>
    <h1>Site Name</h1>
    <hr>
    <div id="main-container">
      <?php
        include_once $_SESSION["Location"];
      ?>
    </div>
  </body>
</html>
<script src="default.js"></script>
<?php
?>