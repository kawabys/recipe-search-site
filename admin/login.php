<?php
session_start();
require '../db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // 管理者ユーザーをDBから取得
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
    $stmt->execute([':username' => $user]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($pass, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: admin.php');
        exit;
    } else {
        $error = 'ユーザー名またはパスワードが違います';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <h2>管理者ログイン</h2>
    <?php if ($error): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <p><input type="text" name="username" placeholder="ユーザー名" required></p>
        <p><input type="password" name="password" placeholder="パスワード" required></p>
        <p><button type="submit">ログイン</button></p>
    </form>
</body>
</html>
