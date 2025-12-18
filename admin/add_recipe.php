<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レシピ追加（管理者用）</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <h2>レシピ追加（管理者用）</h2>
    <nav>
        <a href="admin.php">トップ</a> |
        <a href="list_recipe.php">一覧</a> |
        <a href="logout.php">ログアウト</a>
    </nav>

    <form action="recipe_insert.php" method="post" enctype="multipart/form-data">
        <p><input type="text" name="name" placeholder="レシピ名" required></p>
        <p><textarea name="description" placeholder="説明" required></textarea></p>
        <p><textarea name="ingredients" placeholder="材料（カンマ区切り）" required></textarea></p>
        <p><textarea name="instructions" placeholder="作り方（1. 2. 3. の形式）" required></textarea></p>
        <p><input type="file" name="image" accept="image/*" required></p>
        <p><button type="submit">登録</button></p>
    </form>
</body>
</html>
