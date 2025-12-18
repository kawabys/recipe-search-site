<?php
require 'db.php';

$recipes = [
    [
        "name" => "味噌汁",
        "description" => "毎日飲みたい定番の味噌汁",
        "ingredients" => "味噌, だし, 豆腐, わかめ, ネギ",
        "instructions" => "1. だしを温める 2. 豆腐とわかめを入れる 3. 味噌を溶かす 4. ネギを散らす",
        "image" => "uploads/miso_soup.jpg"
    ],
    [
        "name" => "焼き魚",
        "description" => "簡単にできる塩焼き",
        "ingredients" => "魚, 塩, レモン",
        "instructions" => "1. 魚に塩を振る 2. グリルで焼く 3. レモンを添える",
        "image" => "uploads/grilled_fish.jpg"
    ],
    [
        "name" => "鶏の唐揚げ",
        "description" => "外はカリッと中はジューシー",
        "ingredients" => "鶏もも肉, しょうゆ, 酒, しょうが, にんにく, 小麦粉, 片栗粉, 油",
        "instructions" => "1. 鶏肉を漬け込む 2. 粉をまぶす 3. 揚げる",
        "image" => "uploads/karaage.jpg"
    ],
    [
        "name" => "ナポリタン",
        "description" => "昔ながらの喫茶店風パスタ",
        "ingredients" => "パスタ, ウィンナー, 玉ねぎ, ピーマン, ケチャップ, バター, 塩, こしょう",
        "instructions" => "1. パスタを茹でる 2. 野菜とウィンナーを炒める 3. ケチャップで味付け 4. パスタと混ぜる",
        "image" => "uploads/napolitan.jpg"
    ],
    [
        "name" => "野菜炒め",
        "description" => "簡単で栄養たっぷり",
        "ingredients" => "キャベツ, にんじん, ピーマン, もやし, 塩, こしょう, ごま油",
        "instructions" => "1. 野菜を切る 2. フライパンで炒める 3. 塩こしょうで味付け",
        "image" => "uploads/stir_vege.jpg"
    ],
    [
        "name" => "かぼちゃの煮物",
        "description" => "甘辛い和風煮物",
        "ingredients" => "かぼちゃ, だし, しょうゆ, みりん, 砂糖",
        "instructions" => "1. かぼちゃを切る 2. だしと調味料で煮る",
        "image" => "uploads/kabocha.jpg"
    ],
    [
        "name" => "餃子",
        "description" => "パリッとジューシーな中華の定番",
        "ingredients" => "餃子の皮, 豚ひき肉, キャベツ, ニラ, にんにく, しょうが, 塩, こしょう, ごま油",
        "instructions" => "1. 具材を混ぜる 2. 皮で包む 3. 焼く",
        "image" => "uploads/gyoza.jpg"
    ],
    [
        "name" => "親子煮込みうどん",
        "description" => "温かい和風うどん",
        "ingredients" => "うどん, 鶏肉, 卵, 玉ねぎ, だし, しょうゆ, みりん",
        "instructions" => "1. 玉ねぎと鶏肉を煮る 2. うどんを入れる 3. 卵でとじる",
        "image" => "uploads/oyako_udon.jpg"
    ],
    [
        "name" => "チキンカレー",
        "description" => "スパイシーで本格的な味わい",
        "ingredients" => "鶏肉, 玉ねぎ, にんじん, じゃがいも, カレールー, 水, サラダ油",
        "instructions" => "1. 野菜と鶏肉を炒める 2. 水を加えて煮込む 3. ルーを入れてさらに煮込む",
        "image" => "uploads/chicken_curry.jpg"
    ],
    [
        "name" => "ポテトサラダ",
        "description" => "子供も大好き定番サラダ",
        "ingredients" => "じゃがいも, にんじん, きゅうり, ハム, マヨネーズ, 塩, こしょう",
        "instructions" => "1. じゃがいもを茹でる 2. 野菜を切る 3. 全部混ぜる",
        "image" => "uploads/potato_salad.jpg"
    ],
    [
        "name" => "照り焼きチキン",
        "description" => "甘辛ダレでご飯が進む",
        "ingredients" => "鶏もも肉, しょうゆ, みりん, 砂糖, 酒, サラダ油",
        "instructions" => "1. 鶏肉を焼く 2. タレを加えて煮絡める",
        "image" => "uploads/teriyaki_chicken.jpg"
    ],
    [
        "name" => "麻婆豆腐",
        "description" => "ピリ辛でご飯に合う中華",
        "ingredients" => "豆腐, 豚ひき肉, 長ねぎ, しょうゆ, 甜麺醤, 豆板醤, にんにく, ごま油",
        "instructions" => "1. ひき肉とねぎを炒める 2. 調味料で味付け 3. 豆腐を加える 4. 煮込む",
        "image" => "uploads/mapo_tofu.jpg"
    ],
    [
        "name" => "鯖の味噌煮",
        "description" => "ご飯にぴったりの和食",
        "ingredients" => "鯖, しょうゆ, みりん, 酒, 味噌, 砂糖",
        "instructions" => "1. 調味料を煮立てる 2. 鯖を入れて煮る",
        "image" => "uploads/miso_saba.jpg"
    ],
    [
        "name" => "ラタトゥイユ",
        "description" => "野菜たっぷりフランス風煮込み",
        "ingredients" => "ナス, ズッキーニ, パプリカ, 玉ねぎ, トマト, オリーブオイル, 塩, こしょう",
        "instructions" => "1. 野菜を炒める 2. トマトで煮込む 3. 塩こしょうで味付け",
        "image" => "uploads/ratatouille.jpg"
    ],
    [
        "name" => "カルボナーラ",
        "description" => "濃厚でクリーミーなパスタ",
        "ingredients" => "パスタ, 卵, ベーコン, 粉チーズ, 黒こしょう, 塩",
        "instructions" => "1. パスタを茹でる 2. ベーコンを炒める 3. 卵とチーズで絡める",
        "image" => "uploads/carbonara.jpg"
    ],
    [
        "name" => "きんぴらごぼう",
        "description" => "シャキシャキの和風おかず",
        "ingredients" => "ごぼう, にんじん, しょうゆ, みりん, 砂糖, ごま油, いりごま",
        "instructions" => "1. ごぼうとにんじんを細切り 2. 炒めて調味料で味付け 3. ごまをふる",
        "image" => "uploads/kinpira.jpg"
    ],
    [
        "name" => "フレンチトースト",
        "description" => "朝食にぴったりの甘いトースト",
        "ingredients" => "食パン, 卵, 牛乳, 砂糖, バター, メープルシロップ",
        "instructions" => "1. 卵と牛乳を混ぜる 2. 食パンを浸す 3. バターで焼く 4. メープルをかける",
        "image" => "uploads/french_toast.jpg"
    ],
    [
        "name" => "餅ピザ",
        "description" => "モチモチのおやつピザ",
        "ingredients" => "餅, ピザソース, チーズ, ピーマン, ウィンナー",
        "instructions" => "1. 餅を焼く 2. ソースと具材をのせる 3. チーズをかけて焼く",
        "image" => "uploads/mochi_pizza.jpg"
    ],
    [
        "name" => "たこ焼き",
        "description" => "外はカリッ、中はトロッと",
        "ingredients" => "たこ, たこ焼き粉, 卵, 水, 天かす, ネギ, しょうが, ソース, マヨネーズ",
        "instructions" => "1. たこ焼き粉を溶く 2. 型に流し込む 3. たこと具材を入れる 4. 丸く焼く 5. ソース・マヨをかける",
        "image" => "uploads/takoyaki.jpg"
    ],
    [
        "name" => "ミネストローネ",
        "description" => "野菜たっぷりのイタリアンスープ",
        "ingredients" => "玉ねぎ, にんじん, セロリ, キャベツ, トマト, ベーコン, オリーブオイル, 塩, こしょう",
        "instructions" => "1. 野菜とベーコンを炒める 2. 水とトマトを加えて煮る 3. 塩こしょうで味を調える",
        "image" => "uploads/minestrone.jpg"
    ]
];

// SQL準備
$sql = "INSERT INTO recipes (name, description, ingredients, instructions, image, created_at)
        VALUES (:name, :description, :ingredients, :instructions, :image, NOW())";

$stmt = $pdo->prepare($sql);

foreach ($recipes as $r) {
    try {
        $stmt->execute([
            ':name' => $r['name'],
            ':description' => $r['description'],
            ':ingredients' => $r['ingredients'],
            ':instructions' => $r['instructions'],
            ':image' => $r['image']
        ]);
        echo "レシピ「{$r['name']}」を追加しました。<br>";
    } catch (PDOException $e) {
        echo "エラー: {$r['name']} の追加に失敗しました。<br>";
        echo "詳細: " . $e->getMessage() . "<br>";
    }
}
