<?php
require 'db.php';

$pendingStmt = $conn->query("SELECT * FROM tasks WHERE status='pending' ORDER BY created_at DESC");
$pending = $pendingStmt->fetchAll(PDO::FETCH_ASSOC);

$doneStmt = $conn->query("SELECT * FROM tasks WHERE status='done' ORDER BY created_at DESC");
$done = $doneStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="hero">
            <header class="hero-header">
                <div>
                    <h1>Ma To-Do List</h1>
                    <p class="subtitle">Organisez vos tâches quotidiennes, suivez ce qui est en cours et archivez ce qui est terminé.</p>
                </div>
                <a href="add.php" class="btn-add">+ Ajouter une tâche</a>
            </header>
            <div class="stats-grid">
                <div class="stats-card">
                    <span class="stats-value"><?= count($pending) ?></span>
                    <span class="stats-label">Tâches en cours</span>
                </div>
                <div class="stats-card">
                    <span class="stats-value"><?= count($done) ?></span>
                    <span class="stats-label">Tâches terminées</span>
                </div>
                <div class="stats-card">
                    <span class="stats-value"><?= count($pending) + count($done) ?></span>
                    <span class="stats-label">Total</span>
                </div>
            </div>
        </section>

        <section class="card">
            <h2>En cours (<?= count($pending) ?>)</h2>
            <div class="tasks">
                <?php if (empty($pending)): ?>
                    <p class="empty-state">Aucune tâche en cours pour le moment. Ajoutez une nouvelle tâche pour commencer.</p>
                <?php endif; ?>

                <?php foreach ($pending as $task): ?>
                    <div class="task pending">
                        <p class="title"><?= htmlspecialchars($task['title']) ?></p>
                        <div class="task-actions">
                            <a href="complete.php?id=<?= $task['id'] ?>" class="btn-complete">Terminer</a>
                            <a href="delete.php?id=<?= $task['id'] ?>" class="btn-delete" onclick="return confirm('Supprimer cette tâche ?')">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="card">
            <h2>Terminées (<?= count($done) ?>)</h2>
            <div class="tasks">
                <?php if (empty($done)): ?>
                    <p class="empty-state">Aucune tâche terminée pour l'instant. Terminez une tâche pour l'ajouter ici.</p>
                <?php endif; ?>

                <?php foreach ($done as $task): ?>
                    <div class="task done">
                        <p class="title"><?= htmlspecialchars($task['title']) ?></p>
                        <div class="task-actions">
                            <a href="delete.php?id=<?= $task['id'] ?>" class="btn-delete" onclick="return confirm('Supprimer ?')">Supprimer</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>
</html>