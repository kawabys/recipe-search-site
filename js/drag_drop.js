const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("file-input");
const dropText = document.getElementById("drop-text");

// クリックでファイル選択
dropArea.addEventListener("click", () => {
  fileInput.click();
});

// ドラッグ中
dropArea.addEventListener("dragover", (e) => {
  e.preventDefault();
  dropArea.classList.add("dragover");
});

// 離脱
dropArea.addEventListener("dragleave", () => {
  dropArea.classList.remove("dragover");
});

// ドロップ
dropArea.addEventListener("drop", (e) => {
  e.preventDefault();
  dropArea.classList.remove("dragover");

  const file = e.dataTransfer.files[0];
  if (file) {
    fileInput.files = e.dataTransfer.files;
    previewImage(file);
  }
});

// クリック選択
fileInput.addEventListener("change", () => {
  const file = fileInput.files[0];
  if (file) {
    previewImage(file);
  }
});

// プレビュー表示
function previewImage(file) {
  // 画像以外は弾く
  if (!file.type.startsWith("image/")) {
    alert("画像ファイルを選択してください");
    return;
  }

  const reader = new FileReader();
  reader.onload = () => {
    dropArea.innerHTML = `
      <img src="${reader.result}" alt="プレビュー画像">
      <p>${file.name}</p>
    `;
  };
  reader.readAsDataURL(file);
}
