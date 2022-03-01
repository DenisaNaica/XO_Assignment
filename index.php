<!DOCTYPE html>
<html>
<head>
    <title>XO GAME</title>
    <link rel="stylesheet" href="style.css" type="text/css">

</head>
<body>
    <form method="post" action="register.php">
         <div class="welcome">
             <h1>Start playing XO </h1>
             <h2>Please enter your names here</h2>

             <div class="players">
                 <p>
                    <label for="player_x">Player 1 - X</label>
                    <input id="player_x" type="text" name="player_x" required>
                </p>

                <p>
                    <label for="player_0">Player 2 - 0</label>
                    <input id="palyer_0" type="text" name="player_0" required>
                </p>

            </div>
            <button type="submit">Click to Start the game</button>
        </div>
    </form>
</body>
</html>