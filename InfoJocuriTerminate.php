<?php
    include("template/header.php");
    include("connectionDB.php");
    $id=$_GET['id'];
    $sql = "select * from game where game.id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            $id=$row['id'];
            echo "<li>";
            echo "Id game: ".$row['id']. "<br> ";
            echo "Nume jucator 1: ". $row['player1']. "<br> ";
            echo "Nume jucator 2: ". $row['player2']."<br>";
            echo "Structura jocului este: ". $row['structure_game']. "<br>";
            echo "Status joc: ".$row['status']. "<br> ";
            echo "Castigator: ". $row['winner'];
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "0 results";
    }
    $conn->close();
?>