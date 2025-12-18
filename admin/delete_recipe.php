<?php
session_start();
require '../db.php';
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? 0;

// 画像ファイル削除
$stmt = $pdo->prepare("SELECT image FROM recipes WHERE id = :id");
$stmt->execute([':id' => $id]);
$image = $stmt->fetchColumn();
if ($image && file_exists("../$image")) {
    unlink("../$image");
}

// DB削除
$stmt = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: list_recipe.php');
exit;
