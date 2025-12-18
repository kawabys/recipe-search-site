<?php
// データベース接続
require 'db.php';

// ② id チェック
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    exit("IDが指定されていません");
}
$id = (int)$_GET['id'];

// ③ データベースから取得
$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
$stmt->execute([':id' => $id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$recipe) {
    exit("指定されたレシピが存在しません");
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?= $recipe['name'] ?> - レシピ検索サイト</title>
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
  <div id="sub" class="card">
    <div class="recipe-card">
      <h1 class="recipe-title"><?= htmlspecialchars($recipe['name']) ?></h1>
      <!-- 投稿日時 -->
      <p class="recipe-date">
          <?= date('Y年m月d日 H:i', strtotime($recipe['created_at'])) ?>
      </p>
      <img src="<?= htmlspecialchars($recipe['image']) ?>"style="width:100%; border-radius:10px;">
      <p class="recipe-p"><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
    </div>
    
    <div class="recipe-card">  
      <span class="label">■ 材料</span>
      <p class="recipe-p"><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>
    </div>

    <div class="recipe-card">  
      <span class="label">■ 作り方</span>
      <p class="recipe-p">
      <?php
      // 「1.」「2.」などを改行して整形
      $instructions = preg_replace('/(?<!^)(\d+)\.\s*/', "<br><br>$1. ", $recipe['instructions']);
      echo $instructions;
      ?>
      </p>
    </div>
  </div>
  <footer>レシピ検索サイト</footer>
</body>
</html>