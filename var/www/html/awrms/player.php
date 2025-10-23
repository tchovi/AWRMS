<?php
$config = include __DIR__.'/inc/config.php';
$mount = $config['icecast']['mount'] ?? '/stream';
$host = $config['icecast']['host'] ?? 'localhost';
$port = $config['icecast']['port'] ?? 8000;
$streamUrl = 'http://'.$host.':'.$port.$mount;
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>AWRMS Player</title></head><body>
<h2>AWRMS Player</h2>
<p id="now">Now playing: Unknown</p>
<audio controls autoplay src="<?php echo htmlspecialchars($streamUrl); ?>">Your browser does not support audio.</audio>
<p>Embed: &lt;iframe src="/awrms/player.php" width="400" height="120"&gt;&lt;/iframe&gt;</p>
</body></html>
