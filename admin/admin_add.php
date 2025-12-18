<?php
session_start();
require '../db.php';

// ログインチェック
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        // パスワードをハッシュ化
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // DBに追加
        $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
        $stmt->execute([
            ':username' => $username,
            ':password' => $hash
        ]);
    }
}

header('Location: admin.php');
exit;
