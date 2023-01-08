var wid = document.querySelector('.compilation').clientWidth;
wid = Math.round(wid/440)-1;

document.querySelectorAll('.slide_prev').forEach(e => {
  e.style.display = 'none';
});

document.querySelectorAll('.compilation ul').forEach(e => {
  let slides = 0;
  e.childNodes.forEach((e) =>{
    if(e.tagName == "LI"){
      slides++;
    }
  });
  e.setAttribute('slides', slides);
  if (slides < (wid+2)){
    e.nextSibling.nextSibling.style.display = 'none';
  }
});




function switcher(e){
  let slider = this.parentNode.childNodes[3];
  let x = slider.getAttribute('slide');
  let slides = slider.getAttribute('slides');
  let width = slider.childNodes[1].clientWidth;
  if (x < (slides - (wid-1)) && x > 0){
    if (e.target.className == 'slide_prev'){
      let right = (width + 40) * (x-2);
      slider.childNodes.forEach((e) =>{
        if(e.tagName == "LI"){
          e.style.transform = `translateX(-${right}px)`;
        }
      });
      --x;
      slider.setAttribute('slide', x);
      this.parentNode.childNodes[5].style.display = "block";
    }
    if (e.target.className == 'slide_next'){
      let left = (width + 40) * x;
      slider.childNodes.forEach((e) =>{
        if(e.tagName == "LI"){
          e.style.transform = `translateX(-${left}px)`;
        }
      });
      ++x;
      slider.setAttribute('slide', x);
      this.parentNode.childNodes[7].style.display = "block";
    }

  }
  if (x == (slides - wid)){
    /*правая стрелка*/
    this.parentNode.childNodes[5].style.display = 'none';
  }
  if (x == 1){
    /*левая стрелка*/
    this.parentNode.childNodes[7].style.display = "none";
  }
}
document.querySelectorAll('.slide_next').forEach(e => e.addEventListener('click', switcher.bind(e)));
document.querySelectorAll('.slide_prev').forEach(e => e.addEventListener('click', switcher.bind(e)));
