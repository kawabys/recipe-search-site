<?php
session_start();
require '../db.php';

// ログインチェック
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$id = (int)($_GET['id'] ?? 0);

// 自分自身は削除できない
if ($id && $id != $_SESSION['admin_id']) {
    $stmt = $pdo->prepare("DELETE FROM admins WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: admin.php');
exit;
