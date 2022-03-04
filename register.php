<?php
    require_once("functions.php");


    $player1=$_POST['player_x'];
    $player2=$_POST['player_0'];
    registerPlayers($player1,$player2);
    if(getPlayersRegistred()){
        header("location:play.php");

    }


?>