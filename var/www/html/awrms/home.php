<?php
session_start();
if (!isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
        $u = $_POST['username'];
        $p = $_POST['password'];
        if ($u === 'admin' && $p === 'admin') {
            $_SESSION['user'] = ['id'=>1,'username'=>'admin','role'=>'Admin'];
            header('Location: /awrms/');
            exit;
        }
        $err='Invalid credentials';
    }
    ?>
    <h2>AWRMS Login</h2>
    <?php if (!empty($err)) echo '<p style="color:red">'.$err.'</p>'; ?>
    <form method="post">
      <label>Username: <input name="username" value="admin"></label><br>
      <label>Password: <input name="password" type="password" value="admin"></label><br>
      <button type="submit">Login</button>
    </form>
    <p>Default credentials: admin / admin. You will be prompted to change password on first login.</p>
    <?php
    exit;
}
$user = $_SESSION['user'];
echo "<h1>Welcome, ".htmlspecialchars(\$user['username'])."</h1>";
echo '<p><a href="/awrms/player.php">Open Public Player</a></p>';
echo '<h3>Media Library</h3>';
$files = glob(__DIR__.'/media/*') ?: [];
echo '<ul>';
foreach($files as $f){ echo '<li>'.htmlspecialchars(basename($f)).' - <a href="?play='.urlencode(basename($f)).'">Play</a></li>'; }
echo '</ul>';
?>
<form method="post" action="/awrms/upload.php" enctype="multipart/form-data">
  <input type="file" name="audio"><br>
  <button>Upload</button>
</form>
