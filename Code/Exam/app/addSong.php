<?php
require_once '../db/conection.php';
    $name= $_POST['name'];
    $type = $_POST['type'];
    $artist = $_POST['artist'];

    $sql = "INSERT INTO playlist (name, type, artist) VALUES (:name, :type, :artist)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':artist', $artist);
    if ($stmt->execute()) {
    echo "The song is add";
} else {
    echo "Error";
}
?>