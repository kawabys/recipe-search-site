<?php
// データベース接続
require 'db.php';

// id順で画像とレシピ名を取得
$stmt = $pdo->query("SELECT id, image, name FROM recipes ORDER BY id ASC");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>レシピ検索サイト</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="Description"
      content="レシピ検索サイトでは、投稿されたレシピのキーワード検索、おすすめレシピをチェック、レシピの投稿ができます。">
    <meta name="Keywords" content="レシピ,レシピ検索サイト,料理">
</head>

<body class="list">
  <header><a href="index.php">レシピ検索サイト</a></header>

  <nav>
    <a href="list.php">レシピ一覧</a>
    <a href="recommend.php">おすすめレシピ</a>
    <a href="add.php">レシピ追加</a>
  </nav>

  <div id="searchbox" class="card">
    <p>レシピ検索</p>
    <form action="list.php" method="get">
      <input type="text" name="q" id="search-input">
      <button type="submit" class="button-main">検索</button>
    </form>
  </div>

  <div id="sub" class="card">
    <p>美味しいレシピがたくさん♪</p> 
    <div class="slider">
        <?php foreach($images as $index => $img): ?>
          <a href="recipe.php?id=<?= $img['id'] ?>" class="<?= $index === 0 ? 'active' : '' ?>">
            <img src="<?= htmlspecialchars($img['image']) ?>" alt="<?= htmlspecialchars($img['name']) ?>">
          </a>
        <?php endforeach; ?>
    </div>
  </div>

  <footer>レシピ検索サイト</footer>
  <script src="js/script.js"></script>
</body>
</html>
