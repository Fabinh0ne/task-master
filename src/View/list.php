<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Master - MVC Edition</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; color: #333; display: flex; justify-content: center; padding-top: 50px; }
        .container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 100%; max-width: 600px; }
        h1 { font-size: 1.5rem; text-align: center; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .error { color: #dc2626; background: #fee2e2; padding: 10px; border-radius: 4px; font-size: 0.9rem; margin-bottom: 15px; }
        .form-group { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; margin-bottom: 20px; }
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #2563eb; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        ul { list-style: none; padding: 0; }
        li { display: flex; justify-content: space-between; align-items: flex-start; padding: 12px; border-bottom: 1px solid #eee; }
        li.done strong { text-decoration: line-through; color: #9ca3af; }
        .actions a { text-decoration: none; margin-left: 10px; cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h1>Task Master (MVC Edition)</h1>

    <?php if (isset($error) && $error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=create" class="form-group">
        <input type="text" name="title" placeholder="Título da Tarefa (obrigatório)" autocomplete="off" required>
        <textarea name="description" placeholder="Descrição (opcional)"></textarea>
        <input type="date" name="due_date" required>
        <input type="text" name="assigned_to" placeholder="Responsável (obrigatório)" required>
        <button type="submit">Adicionar Tarefa</button>
    </form>

    <ul>
        <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <li class="<?php echo $task['done'] ? 'done' : ''; ?>">
                    <div>
                        <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                        <?php if (!empty($task['description'])): ?>
                            <br><small><?php echo htmlspecialchars($task['description']); ?></small>
                        <?php endif; ?>
                        <br><span style="font-size: 0.85rem; color: #666;">Vence em: <?php echo htmlspecialchars($task['due_date']); ?> | Responsável: <?php echo htmlspecialchars($task['assigned_to']); ?></span>
                    </div>
                    
                    <div class="actions">
                        <?php if (!$task['done']): ?>
                            <a href="index.php?action=complete&id=<?php echo $task['id']; ?>" title="Concluir">✅</a>
                        <?php endif; ?>
                        <a href="index.php?action=delete&id=<?php echo $task['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');" title="Excluir">❌</a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

</body>
</html>