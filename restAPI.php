
<?php
//This API stores the user playlists in a locally stored html file and returns URL to callback function
//script retrieves html data from index.html and creates a .html with playlist
$playlistNumber = 0;
$file = fopen("playlistCount.txt", "r") or exit("Unable to open file!");
//Getting current playlist number
while(!feof($file))
  {
  $playlistNumber = intval(fgets($file)) + intval(1);
  }
fclose($file);
//Writing new Playlist number to playlistCount.txt
$file = fopen("playlistCount.txt", "w") or exit("Unable to open file!");
fwrite($file,$playlistNumber);
fclose($file);

//creating new HTML playlist
$fileName = './playlists/user';
$extension ='.html';
$handle = fopen($fileName.$playlistNumber.$extension,"w+");
fwrite($handle,"<div>".$_POST['htmlData']."</div>");
fclose($handle);
//returning URL
$URL = $fileName.$playlistNumber.$extension;
echo $URL;
?>
