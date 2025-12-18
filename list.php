<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';

// キーワード取得
$q = isset($_GET['q']) ? trim($_GET['q']) : '';

// ページ設定
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// SQL組み立て
$where = [];
$params = [];

if ($q !== '') {
    $where[] = "(name LIKE :kw_name OR description LIKE :kw_desc OR ingredients LIKE :kw_ing)";
    $params[':kw_name'] = "%$q%";
    $params[':kw_desc'] = "%$q%";
    $params[':kw_ing']  = "%$q%";
}

// 総件数取得
$countSql = "SELECT COUNT(*) FROM recipes";
if (!empty($where)) {
    $countSql .= " WHERE " . implode(' AND ', $where);
}
$countStmt = $pdo->prepare($countSql);
$countStmt->execute($params);
$totalCount = $countStmt->fetchColumn();
$totalPages = ceil($totalCount / $limit);

// データ取得
$sql = "SELECT * FROM recipes";
if (!empty($where)) {
    $sql .= " WHERE " . implode(' AND ', $where);
}
$sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

$stmt = $pdo->prepare($sql);
foreach ($params as $key => $val) {
    $stmt->bindValue($key, $val);
}
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<title>レシピ一覧 - レシピ検索サイト</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="list">

<header><a href="index.php">レシピ検索サイト</a></header>

<nav>
    <a href="list.php">レシピ一覧</a>
    <a href="recommend.php">おすすめレシピ</a>
    <a href="add.php">レシピ追加</a>
</nav>

<!-- 検索フォーム -->
<div id="searchbox" class="card">
    <form action="list.php" method="get">
        <input type="text" name="q" id="search-input" value="<?= htmlspecialchars($q) ?>" placeholder="キーワード検索">
        <button type="submit" class="button-main">検索</button>
    </form>
</div>

<!-- レシピ一覧 -->
<div class="recipes card">
    <?php if (count($recipes) === 0): ?>
        <p>検索条件に該当するレシピはありません。</p>
    <?php else: ?>
        <?php foreach ($recipes as $r): ?>
        <a href="recipe.php?id=<?= $r['id'] ?>">
            <div class="recipe-card">
                <img src="<?= htmlspecialchars($r['image']) ?>" style="width:100%; border-radius:10px;">
                <p class="recipe-date"><?= date('Y年m月d日 H:i', strtotime($r['created_at'])) ?></p>
                <h3 class="recipe-name"><?= htmlspecialchars($r['name']) ?></h3>
                <p class="recipe-description"><?= htmlspecialchars($r['description']) ?></p>
            </div>
        </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- ページネーション -->
<?php if ($totalPages > 1): ?>
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?q=<?= urlencode($q) ?>&page=<?= $page - 1 ?>">&laquo; 前へ</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $page): ?>
            <strong><?= $i ?></strong>
        <?php else: ?>
            <a href="?q=<?= urlencode($q) ?>&page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?q=<?= urlencode($q) ?>&page=<?= $page + 1 ?>">次へ &raquo;</a>
    <?php endif; ?>
</div>
<?php endif; ?>

<footer>レシピ検索サイト</footer>
</body>
</html>
