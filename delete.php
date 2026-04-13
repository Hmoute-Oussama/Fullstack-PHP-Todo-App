<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;