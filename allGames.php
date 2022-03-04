<?php
    include("template/header.php");
    include("connectionDB.php");
    $sql = "select game.id from game where game.status='finished'";
    echo "<h1>". "Lista jocurilor terminate este". "</h1>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            $id=$row['id'];
            echo "<li>";
            echo "<a href="."gameNr.php?id=" .$id.">".$id."</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "0 results";
    }
    $conn->close();
?>





