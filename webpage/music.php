<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>


		<div id="listarea">
			<ul id="musiclist">
				<?php
					if(isset($_REQUEST["playlist"])) {
						$playlist = explode("\n", file_get_contents('songs/'.$_REQUEST["playlist"]));
					} else {
						$playlist = scandir("songs");
					}
					foreach($playlist as $file) {
						$file_basename = basename($file);
						$tmp = explode('.', $file_basename);
						$type = trim(strtolower($tmp[count($tmp)-1]));
						$url = '';
						if($type=='mp3') {
							$url .= "songs/".$file;
							$class = 'mp3item';
						} elseif ($type=='txt') {
							$url .= "music.php?playlist=" . $file_basename;
							$class = 'playlistitem';
						}
						if(in_array($type, ['mp3', 'txt'])) { ?>
						<li class="<?= $class ?>">
							<a href="<?= $url ?>"><?= $file_basename ?></a>
						</li>
						<? } ?>
				<?
					}
				?>
			</ul>
		</div>
	</body>
</html>
