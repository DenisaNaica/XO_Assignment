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
        $_SESSION['PLAYS_COUNT']=0;


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
        //la inregistrare se preia numele fiecarui jucator
        $_SESSION['PLAYER_X_NAME']=$playerX;
        $_SESSION['PLAYER_O_NAME']=$playerO;

        setTurn('x');

        //pt fiecare joc trebuie sa se reseteze tabela
        resetBoard();
        resetWins();
    }


    function playsCount(){
        return $_SESSION['PLAYS_COUNT'] ? $_SESSION['PLAYS_COUNT'] : 0;
    }

    //incrementare nr de x(respectiv 0) a unui player
    function addPlaysCount(){
         if(!$_SESSION['PLAYS_COUNT']){
             $_SESSION['PLAYS_COUNT']=0;
         }

         $_SESSION['PLAYS_COUNT']++;

    }

    function getTurn(){
        return $_SESSION['TURN']?$_SESSION['TURN']:'x';
    }

    //imcrementare nr de castiguri a unui player
    function markWin($player='x'){
        $_SESSION['PLAYER_'. strtoupper($player)."_WINS"]++;
    }

    function switchTurn(){
        switch(getTurn()){
            case 'x':
                setTurn('o');
                break;
            default:
                setTurn('x');
                break;
        }
    }

    function getCell($cell=''){
        return $_SESSION['CELL_'. $cell];
    }

    //verificare castig pe linia verticala
    function isVerticalWin($col=1,$turn='x'){
        return getCell($col) == $turn &&
            getCell($col + 3) == $turn &&
            getCell($col + 6) == $turn;
    }

    //verificare castig pe linia orizontala
    function isHorizontalWin($row=1,$turn='x'){
        return getCell($row)==$turn &&
            getCell($row + 1)==$turn &&
            getCell($row + 2)==$turn;
    }

    // verificare castig pe doiagonala
    function isDiagonalWin($turn='x'){
        $win=getCell(1)==$turn &&
            getCell(9)==$turn;

        if(!$win){
            $win=getCell(3)==$turn&&
                getCell(7)==$turn;
        }

        return $win && getCell(5)==$turn;
    }

    //verificare daca un player a castigat sau nu
    function playerWin($cell=1){
        if(playsCount()<3){
            //un player poate castiga doar daca are minim 3 miscari
            return false;
        }

        $column=$cell%3;
        if(!$column){
            $column=3;
        }
        $row=ceil($cell/3);
        $player=getTurn();

        //un player poate castiga doar daca are x(sau 0) pe linie diagonala sau vericala sau orizontala
        return isVerticalWin($column,$player) || isHorizontalWin($row,$player) || isDiagonalWin($player);
    }

    //implementare joc folosindu -ne de functiile ajutatoare definite
    function play($cell=''){
        if(getCell($cell)){
            return false;
        }

        $_SESSION['CELL_'.$cell]=getTurn();
        addPlaysCount();//crestem nr de miscari a unui player
        $win=playerWin($cell);

        if(!$win){
            //daca nu avem castig dam sansa celuilalt player sa faca o miscare
            switchTurn();
        }else{
            markWin(getTurn());
            //la castig tabela de joc trebuie sa se reseteze
            resetBoard();
        }
        return $win;
    }


