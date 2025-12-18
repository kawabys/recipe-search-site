document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggle-ingredients');
    const list = document.getElementById('ingredient-list');

    if (!toggleBtn || !list) return; // 要素がなければ処理しない

    toggleBtn.addEventListener('click', function() {
        if (list.style.display === 'none') {
            list.style.display = 'block';
            this.textContent = '▲'; // 展開中は上向き矢印
        } else {
            list.style.display = 'none';
            this.textContent = '▼'; // 折りたたみ時は下向き矢印
        }
    });

    // チェック済みの材料がある場合は最初から展開
    const checkedIngredients = list.querySelectorAll('input[type=checkbox]:checked');
    if (checkedIngredients.length > 0) {
        list.style.display = 'block';
        toggleBtn.textContent = '▲';
    }
});
