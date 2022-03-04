<?php
    include("template/header.php");
    if(!getPlayersRegistred()){
        header("location:index.php");
    }

    resetBoard();
?>

<html>
<head>
    <title>
        Result page
    </title>
</head>
<body>
    <table class="wrapper" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="welcome">
                    <h1>
                        <?php
                            if($_GET['player']){
                                echo currentPlayer(). " WON !";
                            }else{
                                echo "It's a tie";
                            }
                        ?>
                    </h1>
                    <h2>
                        <a href="index.php">Exit</a>
                    </h2>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
