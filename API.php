<?php


$mode = mysql_real_escape_string($_GET['mode']);
$databaseName = 'playlists';
$connectionString = "Server: vacj021gjt.database.windows.net,1433 \r\nSQL Database: playlists\r\nUser Name: mukherjeerohit93\r\n\r\nPHP Data Objects(PDO) Sample Code:\r\n\r\ntry {\r\n   $conn = new PDO ( "sqlsrv:server = tcp:vacj021gjt.database.windows.net,1433; Database = playlists", "mukherjeerohit93", "{p@h3eA55}");\r\n    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );\r\n}\r\ncatch ( PDOException $e ) {\r\n   print( "Error connecting to SQL Server." );\r\n   die(print_r($e));\r\n}\r\n\rSQL Server Extension Sample Code:\r\n\r\n$connectionInfo = array("UID" => "mukherjeerohit93@vacj021gjt", "pwd" => "{your_password_here}", "Database" => "playlists", "LoginTimeout" => 30, "Encrypt" => 1);\r\n$serverName = "tcp:vacj021gjt.database.windows.net,1433";\r\n$conn = sqlsrv_connect($serverName, $connectionInfo);";
$conn = sqlsrv_connect($serverName, $connectionInfo);
//Create connection
/*$connection =  mysql_connect('localhost','root','');
mysql_set_charset('UTF-8');
if(!$connection)
	{
		die("Failed");
	}
$db_selected = mysql_select_db($databaseName,$connection);
if(!$db_selected)
	{
    	die('Could not find the database' .mysql_error());
	}

*/
if($mode == 'write')
	{	
		$htmlDataString = mysql_real_escape_string($_GET['htmlData']);
		$query1="SELECT id FROM userplaylists ORDER BY id DESC LIMIT 1";
		$lastId = array();
		$lastEntry = mysql_query($query1); 
		$lastId = mysql_fetch_array($lastEntry);
		$lastIdInt = "$lastId[id]";
		$currentId = intval($lastIdInt) + intval('1');
		$query2 = "INSERT INTO userplaylists(id,htmlData) VALUES ('$currentId','$htmlDataString')";
		if(!mysql_query($query2,$connection))
		    	{
		        	die("At2, Error occured" . mysql_error());
		    	}
		 $readURL = "http://localhost/API.php?mode=read&id=".$currentId;
		 echo $readURL;
    
    }
else if($mode == 'read')
{
		$playlistId = mysql_real_escape_string($_GET['id']);
		$query = "SELECT htmlData FROM userplaylists WHERE id='$playlistId'";
		$result = mysql_query($query);
		$resultArray = array();
		$resultArray = mysql_fetch_array($result);
		$playlistHTML = "$resultArray[htmlData]";
		echo $playlistHTML;

}
?>