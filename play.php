<?php
    require_once("template/header.php");
    include("connectionDB.php");
    //aici se va stoca structura jocului sub forma de array
    $table_game=['-','-','-','-','-','-','-','-','-'];

    //pt a putea face insert in baza de date trebuie sa convertim arrayul de mai sus in string
    $string_game="";

    $status_game=0;//1 cand avem castig

    $player1 = playerName('x');
    $player2 = playerName('o');

    if(!getPlayersRegistred()){
        header("location: index.php");
    }

    if($_POST['cell']){
        $win=play($_POST['cell']);

        if($win){
            $status_game=1;
            header("location: result.php?player=" . getTurn());
        }
    }
    if(playsCount()>=9){
        header("location: result.php");
    }
    ?>
<html>
<head>
    <title>Game Page</title>
</head>
<body>
    <h2> Welcome to the Game</h2>
    <h2>
        <?php
            echo '<br><br><br>'.currentPlayer()
        ?> 's turn
    </h2>
    <form method="post" action="play.php">
        <table class="xo-game" cellpadding="0" cellspacing="0">
            <tbody>
            <?php
                $last_row=0;
                for($i=1;$i<=9;$i++) {
                    $row = ceil($i / 3);

                    if ($row !== $last_row) {
                        $last_row = $row;

                        if ($i > 1) {
                            echo "<tr>";
                        }

                        echo "<tr class='row-{$row}'>";
                    }

                    $addClass = '';

                    if ($i == 2 || $i == 8) {
                        $addClass = 'v-border';
                    } else if ($i == 4 || $i == 6) {
                        $addClass = 'h-border';
                    } else if ($i == 5) {
                        $addClass = 'c-border';
                    }

                    ?>
                    <td class="cell-<?= $i ?> <?=$addClass ?>">
                    <?php if(getCell($i)==='x'): ?>
                            X
                        <?php elseif (getCell($i)==='o'):?>
                            0
                        <?php else:?>
                             <input type="checkbox" name="cell" value="<?= $i?>" onclick="enbableButton()"/>
                        <?php endif;?>


                        <?php
                            if(getCell($i)==='x'){
                                $table_game[$i-1]='X';
                            }else if(getCell($i)==='o'){
                                $table_game[$i-1]='0';
                            }

                            $string_game=implode(",",$table_game);
                        ?>
                    </td>
            <?php } ?>
            </tr>
            </tbody>
        </table>

        <?php
            if($status_game==1) {
                //cazul in care avem castig
                $winner = currentPlayer();
                $sql = "insert game(player1,player2,structure_game,status,winner) values('$player1', '$player2', '$string_game', 'finished','$winner');";
                $result = $conn->query($sql);
                $conn->close();
            }else if($status_game==0 && playsCount()>=9){
                //cazul in care avem remiza
                $sql = "insert game(player1,player2,structure_game,status,winner) values('$player1', '$player2', '$string_game', 'tie','no-winner');";
                $result = $conn->query($sql);
                $conn->close();
            }
        ?>

        <button id="play" type="submit" disabled>Play</button>
        <a href="saveDb.php">Leave and Save game</a>
    </form>
    <script type="text/javascript">
        function enbableButton(){
            document.getElementById('play').disabled=false;
        }
    </script>
</body>
</html>
