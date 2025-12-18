<?php
// データベース接続
require 'db.php';

// ② ランダムに5件取得
$stmt = $pdo->query("SELECT * FROM recipes ORDER BY RAND() LIMIT 5");
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>おすすめレシピ - レシピ検索サイト</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
  <header><a href="index.php">レシピ検索サイト</a></header>

  <nav>
    <a href="list.php">レシピ一覧</a>
    <a href="recommend.php">おすすめレシピ</a>
    <a href="add.php">レシピ追加</a>
  </nav>

  <h3 style="margin-left:20px;">おすすめレシピ5選</h3>

  <div id="recommend-list"></div>


  <div class="recipes card">
    <?php foreach ($recipes as $r): ?>  
      <!-- recipe.php に id を渡す -->
      <a href="recipe.php?id=<?= $r['id'] ?>">
          <div class="recipe-card">
              <img src="<?= htmlspecialchars($r['image']) ?>" style="width:100%; border-radius:10px;">
              <!-- 投稿日時 -->
              <p class="recipe-date">
                  <?= date('Y年m月d日 H:i', strtotime($r['created_at'])) ?>
              </p>
              <h3 class="recipe-name"><?= htmlspecialchars($r['name']) ?></h3>
              <p class="recipe-description"><?= htmlspecialchars($r['description']) ?></p>
          </div>
      </a>
    <?php endforeach; ?>
  </div>
  <footer>レシピ検索サイト</footer>
</body>
</html>

