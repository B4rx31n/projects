<?php
// Koneksi database (simpan di file db.php)
require 'db.php';

// Tambah tugas baru
if (isset($_POST['task']) && isset($_POST['tanggal']) && empty($_POST['id'])) {
    $task = trim($_POST['task']);
    $tanggal = $_POST['tanggal'];
    if ($task !== '') {
        $stmt = $conn->prepare("INSERT INTO todos (task, tanggal) VALUES (?, ?)");
        $stmt->bind_param("ss", $task, $tanggal);
        $stmt->execute();
    }
    header("Location: index.php");
    exit;
}

// Update tugas yang ada
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = (int)$_POST['id'];
    $task = trim($_POST['task']);
    $tanggal = $_POST['tanggal'];
    if ($task !== '') {
        $stmt = $conn->prepare("UPDATE todos SET task = ?, tanggal = ? WHERE id = ?");
        $stmt->bind_param("ssi", $task, $tanggal, $id);
        $stmt->execute();
    }
    header("Location: index.php");
    exit;
}

// Tandai selesai/belum selesai
if (isset($_GET['done'])) {
    $id = (int)$_GET['done'];
    $conn->query("UPDATE todos SET done = NOT done WHERE id = $id");
    header("Location: index.php");
    exit;
}

// Hapus tugas
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM todos WHERE id = $id");
    header("Location: index.php");
    exit;
}

// Ambil semua data todos
$todos = $conn->query("SELECT * FROM todos ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);

// Cek mode edit
$editMode = false;
$editData = ['id' => '', 'task' => '', 'tanggal' => ''];
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $result = $conn->query("SELECT * FROM todos WHERE id = $editId");
    if ($result->num_rows > 0) {
        $editMode = true;
        $editData = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern To-Do List App</title>
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #ff0000ff;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --border-radius: 8px;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
            padding: 2rem;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        
        h1 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-box {
            background-color: var(--light);
            padding: 1.5rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }
        
        .form-group {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        
        .form-control {
            flex: 1;
            min-width: 200px;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--gray);
            color: var(--gray);
        }
        
        .btn-outline:hover {
            background-color: #e9ecef;
        }
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #ff0000ff;
        }
        
        .btn-success {
            background-color: #2ecc71;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #27ae60;
        }
        
        .edit-label {
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 0.5rem;
            font-style: italic;
        }
        
        .todo-list {
            list-style: none;
        }
        
        .todo-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background-color: white;
            border-radius: var(--border-radius);
            margin-bottom: 0.75rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .todo-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .todo-content {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .todo-text {
            flex: 1;
        }
        
        .done .todo-text {
            text-decoration: line-through;
            color: var(--gray);
        }
        
        .todo-date {
            font-size: 0.85rem;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .todo-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--gray);
        }
        
        @media (max-width: 600px) {
            .form-group {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .form-control {
                width: 100%;
            }
            
            .todo-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .todo-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 To-Do List App</h1>
        
        <div class="form-box">
            <form method="post">
                <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                <div class="form-group">
                    <input type="text" class="form-control" name="task" placeholder="kegiatan" 
                           value="<?= htmlspecialchars($editData['task']) ?>" required>
                    <input type="date" class="form-control" name="tanggal" value="<?= $editData['tanggal'] ?>">
                    <button type="submit" class="btn btn-primary">
                        <?= $editMode ? '💾 Simpan Perubahan' : '➕ Tambah Task' ?>
                    </button>
                    <?php if ($editMode): ?>
                        <a href="index.php" class="btn btn-outline">❌ Batal</a>
                    <?php endif; ?>
                </div>
                <?php if ($editMode): ?>
                    <div class="edit-label">Sedang mengedit task #<?= $editData['id'] ?></div>
                <?php endif; ?>
            </form>
        </div>
        
        <?php if (empty($todos)): ?>
            <div class="empty-state">
                <p>Belum ada task. Yuk tambahkan task pertama Anda!</p>
            </div>
        <?php else: ?>
            <ul class="todo-list">
                <?php foreach ($todos as $todo): ?>
                    <li class="todo-item <?= $todo['done'] ? 'done' : '' ?>">
                        <div class="todo-content">
                            <div class="todo-text">
                                <?= htmlspecialchars($todo['task']) ?>
                            </div>
                            <?php if ($todo['tanggal']): ?>
                                <div class="todo-date">
                                    📅 <?= htmlspecialchars($todo['tanggal']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="todo-actions">
                            <a href="?done=<?= $todo['id'] ?>" class="btn btn-sm <?= $todo['done'] ? 'btn-outline' : 'btn-success' ?>">
                                <?= $todo['done'] ? '↩ Batal' : '✓ Selesai' ?>
                            </a>
                            <a href="?edit=<?= $todo['id'] ?>" class="btn btn-sm btn-outline">✏️ Edit</a>
                            <a href="?delete=<?= $todo['id'] ?>" class="btn btn-sm btn-danger">🗑️ Hapus</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>