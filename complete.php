<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];  
    $stmt = $conn->prepare("UPDATE tasks SET status='done' WHERE id=?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;