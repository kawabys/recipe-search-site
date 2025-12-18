<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>レシピ追加 - レシピ検索サイト</title>
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

  <h3 style="margin-left:20px;">レシピ追加</h3>

  <form action="recipe_insert.php" method="post" enctype="multipart/form-data">
      <p><input type="text" name="name" placeholder="レシピ名" required></p>
      <p><textarea name="description" placeholder="説明" required></textarea></p>
      <p><textarea name="ingredients" placeholder="材料（カンマ区切り）" required></textarea></p>
      <p><textarea name="instructions" placeholder="作り方（半角数字とピリオド付きで　1.~2.~3.~）" required></textarea></p>
      <!-- ドロップエリア -->
      <div id="drop-area">
        <p>画像をドラッグ＆ドロップ<br>またはクリックして選択</p>
        <input type="file" name="image" id="file-input" accept="image/*" required>
      </div>
      <p><button type="submit" class="send-button">登録</button></p>
  </form>


  <footer>レシピ検索サイト</footer>
  <script src="js/drag_drop.js"></script>
</body>
</html>



