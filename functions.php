<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);

    function setTurn($turn='x'){
        $_SESSION['TURN']=$turn;
    }

    function getPlayersRegistred(){
        return $_SESSION['PLAYER_X_NAME'] && $_SESSION['PLAYER_O_NAME'];
    }

    function resetPlaysCount(){
        //setam nr de miscari pe tabla de x si 0 cu 0
        return $_SESSION['PLAYS_COUNT']?$_SESSION['PLAYS_COUNT']:0;

    }

    function resetBoard(){
        resetPlaysCount();

        for($index=1;$index<=9;$index++){
            unset($_SESSION['CELL_' . $index]);
        }
    }

    function resetWins(){
        //in momentul in care avem noi useri trebuie sa resetam nr de victorii a fiecarui jucator la 0
        $_SESSION['PLAYER_X_WINS']=0;
        $_SESSION['PLAYER_O_WINS']=0;
    }

    function registerPlayers($playerX="", $playerO=""){
        //la inregistrare se preia numele fiecarui jucator,
        $_SESSION['PLAYER_X_NAME']=$playerX;
        $_SESSION['PLAYER_O_NAME']=$playerO;

        //se seteaza ca primul jucator va fi cel care va marca x pe tabela de joc
        setTurn('x');

        //pt fiecare joc trebuie sa se reseteze tabela
        resetBoard();
        resetWins();
    }

