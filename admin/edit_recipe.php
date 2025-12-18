<?php
require '../db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) exit('無効なIDです');

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
$stmt->execute([':id' => $id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) exit('レシピが存在しません');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/admin_style.css">
<title>レシピ編集</title>
</head>
<body>
<h2>レシピ編集</h2>

<form action="update_recipe.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($recipe['id']) ?>">

    <p><input type="text" name="name" value="<?= htmlspecialchars($recipe['name']) ?>" required></p>
    <p><textarea name="description" required><?= htmlspecialchars($recipe['description']) ?></textarea></p>
    <p><textarea name="ingredients" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea></p>
    <p><textarea name="instructions" required><?= htmlspecialchars($recipe['instructions']) ?></textarea></p>

    <p>現在の画像:</p>
    <img src="../<?= htmlspecialchars($recipe['image']) ?>" style="max-width:200px; display:block; margin-bottom:10px;">

    <p>画像を変更する場合はこちら:</p>
    <input type="file" name="image" accept="image/*">

    <p><button type="submit">更新</button></p>
</form>

<a href="admin.php">管理画面に戻る</a>
</body>
</html>
