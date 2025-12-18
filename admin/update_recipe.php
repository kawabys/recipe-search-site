<?php
/*************************************************
 * レシピ更新処理（管理者用・本番安全版）
 *************************************************/

// 本番ではエラー非表示
ini_set('display_errors', 0);
error_reporting(0);

require '../db.php';

// ===== 入力取得 =====
$id           = intval($_POST['id'] ?? 0);
$name         = trim($_POST['name'] ?? '');
$description  = trim($_POST['description'] ?? '');
$ingredients  = trim($_POST['ingredients'] ?? '');
$instructions = trim($_POST['instructions'] ?? '');

// ===== 必須チェック =====
if ($id <= 0 || $name === '') {
    exit('必須項目が未入力です');
}

// ===== テキスト長チェック =====
if (mb_strlen($name) > 100) exit('レシピ名は100文字以内で入力してください');
if (mb_strlen($description) > 500) exit('説明は500文字以内で入力してください');
if (mb_strlen($ingredients) > 1000) exit('材料は1000文字以内で入力してください');
if (mb_strlen($instructions) > 2000) exit('作り方は2000文字以内で入力してください');

// ===== 画像アップロードチェック =====
$updateImage = false;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        exit('対応していない画像形式です');
    }
    if (!getimagesize($_FILES['image']['tmp_name'])) {
        exit('画像ファイルではありません');
    }
    if ($_FILES['image']['size'] > 3 * 1024 * 1024) {
        exit('画像サイズは3MBまでです');
    }

    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $filename   = uniqid('img_', true) . '.' . $ext;
    $targetFile = $uploadDir . $filename;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        exit('画像保存に失敗しました');
    }
    $updateImage = true;
}

// ===== DB更新 =====
if ($updateImage) {
    $stmt = $pdo->prepare(
        "UPDATE recipes
         SET name = :name, description = :description, ingredients = :ingredients,
             instructions = :instructions, image = :image
         WHERE id = :id"
    );
    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':ingredients' => $ingredients,
        ':instructions' => $instructions,
        ':image' => $targetFile,
        ':id' => $id
    ]);
} else {
    $stmt = $pdo->prepare(
        "UPDATE recipes
         SET name = :name, description = :description, ingredients = :ingredients,
             instructions = :instructions
         WHERE id = :id"
    );
    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':ingredients' => $ingredients,
        ':instructions' => $instructions,
        ':id' => $id
    ]);
}

// ===== 完了 =====
header('Location: admin.php');
exit;
