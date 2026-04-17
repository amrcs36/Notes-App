<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_note'])) {
    $title = sanitize_input($_POST['title']);
    $content = sanitize_input($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $title, $content]);
        $message = "<p style='color:green;'>Note added successfully!</p>";
    } else {
        $message = "<p style='color:red;'>Title and content cannot be empty.</p>";
    }
}

if (isset($_GET['delete'])) {
    $note_id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");
    $stmt->execute([$note_id, $user_id]);
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Notes</title>
    <style>
        .note-card { border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; border-radius: 5px; }
        .note-title { margin: 0 0 10px 0; color: #333; }
        .note-date { font-size: 0.8em; color: #777; }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="logout.php">Logout</a>
    <hr>

    <h3>Add a New Note</h3>
    <?php echo $message; ?>
    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" style="width: 300px;" required><br><br>
        <label>Content:</label><br>
        <textarea name="content" rows="5" style="width: 300px;" required></textarea><br><br>
        <button type="submit" name="add_note">Save Note</button>
    </form>

    <hr>
    <h3>Your Notes</h3>
    <?php if (count($notes) > 0): ?>
        <?php foreach ($notes as $note): ?>
            <div class="note-card">
                <h4 class="note-title"><?php echo htmlspecialchars($note['title']); ?></h4>
                <p><?php echo nl2br(htmlspecialchars($note['content'])); ?></p>
                <span class="note-date">Created at: <?php echo $note['created_at']; ?></span>
                <br><br>
                <a href="index.php?delete=<?php echo $note['id']; ?>" onclick="return confirm('Are you sure you want to delete this note?');" style="color:red;">Delete Note</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You don't have any notes yet.</p>
    <?php endif; ?>

</body>
</html>