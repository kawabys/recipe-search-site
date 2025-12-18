<?php
/*************************************************
 * レシピ登録処理（一般ユーザー可・本番安全版）
 *************************************************/

// 本番ではエラー非表示（開発中のみ ON）
ini_set('display_errors', 0);
error_reporting(0);

require 'db.php';

// ===== 入力取得 & トリム =====
$name         = trim($_POST['name'] ?? '');
$description  = trim($_POST['description'] ?? '');
$ingredients  = trim($_POST['ingredients'] ?? '');
$instructions = trim($_POST['instructions'] ?? '');

// ===== 必須チェック =====
if ($name === '' || empty($_FILES['image']['name'])) {
    exit('必須項目が未入力です');
}

// ===== テキスト長チェック（DB保護） =====
if (mb_strlen($name) > 100) exit('レシピ名は100文字以内で入力してください');
if (mb_strlen($description) > 500) exit('説明は500文字以内で入力してください');
if (mb_strlen($ingredients) > 1000) exit('材料は1000文字以内で入力してください');
if (mb_strlen($instructions) > 2000) exit('作り方は2000文字以内で入力してください');

// ===== 画像アップロードチェック =====
if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    exit('画像アップロードに失敗しました');
}

// ===== 拡張子チェック =====
$allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $allowedExt, true)) {
    exit('対応していない画像形式です');
}

// ===== 画像中身チェック（本当に画像か） =====
if (!getimagesize($_FILES['image']['tmp_name'])) {
    exit('画像ファイルではありません');
}

// ===== 画像サイズチェック（3MBまで） =====
if ($_FILES['image']['size'] > 3 * 1024 * 1024) {
    exit('画像サイズは3MBまでです');
}

// ===== 保存先設定 =====
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// ===== 安全なファイル名 =====
$filename   = uniqid('img_', true) . '.' . $ext;
$targetFile = $uploadDir . $filename;

// ===== 画像保存 =====
if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    exit('画像保存に失敗しました');
}

// ===== DB登録（SQLインジェクション対策済） =====
$stmt = $pdo->prepare(
    "INSERT INTO recipes
     (name, description, ingredients, instructions, image)
     VALUES (:name, :description, :ingredients, :instructions, :image)"
);

$stmt->execute([
    ':name'         => $name,
    ':description'  => $description,
    ':ingredients'  => $ingredients,
    ':instructions' => $instructions,
    ':image'        => $targetFile
]);

// ===== 完了 =====
header('Location: list.php');
exit;
?>
