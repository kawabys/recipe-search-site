<?php
session_start();
require '../db.php';

// ログインチェック
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// 管理者一覧取得
$stmt = $pdo->query("SELECT id, username FROM admins ORDER BY id ASC");
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>管理者画面</title>
<link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<h2>管理者画面トップ</h2>
<nav>
    <a href="list_recipe.php">レシピ一覧管理</a> |
    <a href="add_recipe.php">レシピ追加</a> |
    <a href="logout.php">ログアウト</a>
</nav>

<h2 class="adh2">管理者管理</h2>

<h3>現在の管理者一覧</h3>
<table>
    <tr>
        <th>ID</th>
        <th>ユーザー名</th>
        <th>操作</th>
    </tr>
    <?php foreach ($admins as $admin): ?>
    <tr>
        <td><?= $admin['id'] ?></td>
        <td><?= htmlspecialchars($admin['username']) ?></td>
        <td>
            <?php if ($admin['id'] != $_SESSION['admin_id']): // 自分自身は削除不可 ?>
            <a href="admin_delete.php?id=<?= $admin['id'] ?>" onclick="return confirm('削除しますか？');">削除</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>新しい管理者を追加</h3>
<form action="admin_add.php" method="post">
    <input type="text" name="username" placeholder="ユーザー名" required>
    <input type="password" name="password" placeholder="パスワード" required>
    <button type="submit">追加</button>
</form>

</body>
</html>
