
<?php
require '../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$confirmado = $_GET['confirmado'] ?? '0';

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

if ($confirmado !== '1') {
    echo '<script>
        if (confirm("Tem certeza de que deseja excluir esta tarefa?")) {
            window.location.href = "excluir.php?id=' . $id . '&confirmado=1";
        } else {
            window.location.href = "index.php";
        }
    </script>';
    exit;
}

$q = $pdo->prepare('DELETE FROM tarefas WHERE id = ?');
$q->execute([$id]);

header('Location: index.php');
exit;
