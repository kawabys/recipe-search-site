<?php
require '../db.php';

// ===== 管理者テーブル作成 =====
$sql = "
CREATE TABLE IF NOT EXISTS admins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$pdo->exec($sql);
echo "管理者テーブル作成完了<br>";

// ===== 初期管理者追加 =====
// ユーザー名とパスワード
$init_user = 'admin';
$init_pass = 'password123';

// パスワードをハッシュ化
$hash = password_hash($init_pass, PASSWORD_DEFAULT);

// 既に存在するかチェック
$stmt = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE username = :username");
$stmt->execute([':username' => $init_user]);
if ($stmt->fetchColumn() == 0) {
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
    $stmt->execute([
        ':username' => $init_user,
        ':password' => $hash
    ]);
    echo "初期管理者 '{$init_user}' を追加しました。<br>";
} else {
    echo "初期管理者 '{$init_user}' は既に存在します。<br>";
}

echo "完了しました。";
?>
