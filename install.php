<?php
// データベース接続
require 'db.php';

// ② テーブル作成（name と image の組み合わせをユニークにする）
$sql = "CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    description TEXT,
    ingredients TEXT,
    instructions TEXT,
    image VARCHAR(255) NOT NULL,
    UNIQUE KEY unique_recipe (name, image)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$pdo->exec($sql);
echo "テーブルを作成しました！<br>";

// ③ 初期データ
$recipes = [
    [
        "name" => "しょうゆバターパスタ",
        "description" => "簡単で美味しい和風パスタ",
        "ingredients" => "パスタ, しょうゆ, バター, 塩, こしょう",
        "instructions" => "1. パスタを茹でる 2. フライパンでバターとしょうゆを混ぜる 3. 茹でたパスタと合わせて塩こしょうで味を調える",
        "image" => "img/shoyu_butter_pasta.jpg"
    ],
    [
        "name" => "オムライス",
        "description" => "ふわとろ卵がポイント",
        "ingredients" => "卵, ご飯, 鶏肉, 玉ねぎ, ケチャップ, 塩, こしょう",
        "instructions" => "1. 玉ねぎと鶏肉を炒める 2. ご飯を混ぜる 3. 卵で包む 4. ケチャップをかける",
        "image" => "img/omelette.jpg"
    ],
    [
        "name" => "カレーライス",
        "description" => "スパイシーで大人も子供も楽しめる",
        "ingredients" => "牛肉, 玉ねぎ, 人参, じゃがいも, カレールー, 水",
        "instructions" => "1. 野菜と肉を炒める 2. 水を加えて煮る 3. カレールーを溶かす 4. さらに煮込む",
        "image" => "img/curry.jpg"
    ],
    [
        "name" => "親子丼",
        "description" => "鶏肉と卵の定番どんぶり",
        "ingredients" => "鶏もも肉, 卵, 玉ねぎ, だし, しょうゆ, みりん",
        "instructions" => "1. 玉ねぎと鶏肉を煮る 2. 卵でとじる 3. ご飯にのせる",
        "image" => "img/oyakodon.jpg"
    ],
    [
        "name" => "ハンバーグ",
        "description" => "ジューシーでボリューム満点",
        "ingredients" => "合挽き肉, 玉ねぎ, パン粉, 卵, 塩, こしょう, ケチャップ",
        "instructions" => "1. 材料を混ぜる 2. 成形する 3. 焼く 4. ソースをかける",
        "image" => "img/hamburg.jpg"
    ],
    [
        "name" => "ミートスパゲッティ",
        "description" => "トマトソースたっぷりの定番パスタ",
        "ingredients" => "パスタ, 合挽き肉, 玉ねぎ, トマトソース, にんにく, 塩, こしょう",
        "instructions" => "1. 玉ねぎと肉を炒める 2. トマトソースを加える 3. 茹でたパスタにかける",
        "image" => "img/spaghetti.jpg"
    ],
    [
        "name" => "シーザーサラダ",
        "description" => "レタスたっぷり、ヘルシーで美味しい",
        "ingredients" => "レタス, クルトン, パルメザンチーズ, シーザードレッシング",
        "instructions" => "1. レタスをちぎる 2. クルトンとチーズをのせる 3. ドレッシングをかける",
        "image" => "img/caesar_salad.jpg"
    ],
    [
        "name" => "パンケーキ",
        "description" => "ふわふわで甘さ控えめの朝食にぴったり",
        "ingredients" => "小麦粉, 卵, 牛乳, 砂糖, ベーキングパウダー, バター",
        "instructions" => "1. 材料を混ぜる 2. フライパンで焼く 3. 好みでメープルシロップをかける",
        "image" => "img/pancake.jpg"
    ]
];

// ④ データ登録（名前と画像が同じ場合は追加されない）
$stmt = $pdo->prepare("
    INSERT IGNORE INTO recipes (name, description, ingredients, instructions, image) 
    VALUES (:name, :description, :ingredients, :instructions, :image)
");

foreach ($recipes as $recipe) {
    $stmt->execute([
        ':name' => $recipe['name'],
        ':description' => $recipe['description'],
        ':ingredients' => $recipe['ingredients'],
        ':instructions' => $recipe['instructions'],
        ':image' => $recipe['image']
    ]);
}

echo "初期データを登録しました！<br>";
echo "※同じ名前と画像の組み合わせは重複しません。";
?>
