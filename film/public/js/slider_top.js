let currentSlide = 0;
let lines = document.querySelectorAll('.line_slide');

document.querySelector('.arr_right').addEventListener('click', () => {
  swipeSliderTop(1);
});
document.querySelector('.arr_left').addEventListener('click', () => {
  swipeSliderTop(-1);
});


function swipeSliderTop(mult){
  document.querySelector('.arr_left').style.display = "block";
  if (currentSlide <= 5 && currentSlide > -1){
    currentSlide = currentSlide + mult;
    console.log(currentSlide);
    document.querySelectorAll('.film_slide').forEach(e => {
      e.style.transform = `translateX(-${currentSlide * 100}%)`;
    });
  }
  if(currentSlide == 5){
    document.querySelector('.arr_right').style.display = "none";
  }
  if(currentSlide == 0){
    document.querySelector('.arr_left').style.display = "none";
  }
  lines.forEach(e => {
    e.classList.remove('active');
  });
  lines[currentSlide].classList.add('active');
}
