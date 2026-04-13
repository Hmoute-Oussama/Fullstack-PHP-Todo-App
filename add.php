<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    if (!empty($title)) {
        $stmt = $conn->prepare("INSERT INTO tasks (title) VALUES (?)");
        $stmt->execute([$title]);
    }
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="card">
            <header>
                <div>
                    <h1>➕ Nouvelle tâche</h1>
                    <p class="subtitle">Ajoutez rapidement une nouvelle tâche et revenez à votre liste.</p>
                </div>
            </header>
            <form method="POST" style="margin-top: 22px;">
                <label for="title" style="display:none;">Titre de la tâche</label>
                <input type="text" id="title" name="title" placeholder="Que voulez-vous faire ?" required autofocus />
                <button type="submit">Ajouter</button>
            </form>
            <a href="index.php" class="btn-secondary">← Retour à la liste</a>
        </section>
    </main>
</body>
</html>