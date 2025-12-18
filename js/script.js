document.addEventListener('DOMContentLoaded', () => {
  const slides = document.querySelectorAll('#sub .slider a');
  if (slides.length === 0) return;

  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
    });
  }

  // 最初のスライドを表示
  showSlide(current);

  // 2.5秒ごとに次のスライドへ
  setInterval(() => {
    current = (current + 1) % slides.length;
    showSlide(current);
  }, 2500);
});
