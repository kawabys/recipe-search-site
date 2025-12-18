<?php
session_start();
require '../db.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

// レシピ一覧取得
$stmt = $pdo->query("SELECT * FROM recipes ORDER BY id DESC");
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レシピ一覧管理</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <h2>レシピ一覧管理</h2>
    <nav>
        <a href="admin.php">トップ</a> |
        <a href="add_recipe.php">レシピ追加</a> |
        <a href="logout.php">ログアウト</a>
    </nav>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>画像</th>
            <th>操作</th>
        </tr>
        <?php foreach ($recipes as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td><img src="../<?= htmlspecialchars($r['image']) ?>" width="80"></td>
            <td>
                <a href="edit_recipe.php?id=<?= $r['id'] ?>">編集</a> |
                <a href="delete_recipe.php?id=<?= $r['id'] ?>" onclick="return confirm('削除しますか？');">削除</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
