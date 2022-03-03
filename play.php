<?php
    require_once("template/header.php");
    if(!getPlayersRegistred()){
        header("location: index.php");
    }

    if($_POST['cell']){
        $win=play($_POST['cell']);

        if($win){
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
                    </td>
            <?php } ?>
            </tr>
            </tbody>
        </table>

        <button id="play" type="submit" disabled>Play</button>
    </form>
    <script type="text/javascript">
        function enbableButton(){
            document.getElementById('play').disabled=false;
        }
    </script>
</body>
</html>
