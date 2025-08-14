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

  ?>
  <p><?php echo "Your IP: " . $_SERVER['REMOTE_ADDR']; ?></p>
  <input id="user" name="user" type="text" value="" placeholder="User">
  <br>
  <input id="pw" name="pw" type="password" value="" placeholder="Password">
  <br>
  <input id="check" type="button" value="Login" onclick="SEND_VALS('manage_accounts.php', [document.getElementById('user').value, document.getElementById('pw').value, 'check']);">
  <input id="check" type="button" value="Sign up" onclick="GET_CONTENT('/sign_up.php', 'main-container');">
  <br>
  <a id="link-location"></a>
  <?php
?>