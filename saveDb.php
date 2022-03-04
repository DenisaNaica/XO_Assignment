<?php
    include_once("play.php");
    include("connectionDB.php");

    $player1 = playerName('x');
    $player2 = playerName('o');
    $sql = "insert game(player1,player2,structure_game,status,winner) values('$player1', '$player2', '$string_game', 'unfinished','-');";
    $result = $conn->query($sql);
    $conn->close();
?>
<html>
<head>
</head>
<body>
    <h1> Pause</h1>
    <center>
        <a href="play.php">Go back & resume the game</a>
    </center>
    <img src="38802.jpg" width="1700px", height="1200px"/>
</body>
</html>


