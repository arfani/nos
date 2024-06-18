// import Swiper JS
import Swiper from 'swiper';
import { Autoplay, EffectCards, Navigation, Thumbs, EffectCoverflow, EffectCube } from 'swiper/modules';
// import Swiper styles
import 'swiper/css/bundle';

Swiper.use([Autoplay, EffectCards, Thumbs, Navigation, EffectCoverflow, EffectCube]);

const heroSwiper = new Swiper('.heroSwiper', {
  autoplay: {delay: 1500},
  loop: true,
});

var lelangSwiper = new Swiper(".lelangSwiper", {
  effect: "cube",
  grabCursor: true,
  loop: true,
  autoplay: true,
});

var promoSwiper = new Swiper(".promoSwiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 50,
    stretch: 0,
    depth: 100,
    modifier: 1,
    slideShadows: true,
  },
  pagination: {
    el: ".swiper-pagination",
  },
  autoplay: { delay: 2000 },
  loop: true,
});


var testimonialSwiper = new Swiper(".testimonialSwiper", {
  // effect: "cards",
  grabCursor: true,
  loop: true,
  autoplay: {
    delay: 5000
  },
});

var testimonialSwiper2 = new Swiper(".testimonialSwiper2", {
  effect: "cards",
  grabCursor: true,
  // loop:true,
  autoplay: {
    delay: 2000
  },
});

// for FAQ section
document.addEventListener('DOMContentLoaded', function() {
  // TOGGLE COLLAPSE FAQ
  const collapses = document.querySelectorAll('.collapse');
  collapses.forEach((collapse, index) => {
      const title = collapse.querySelector('.collapse-title');
      const radio = collapse.querySelector('input[type="radio"]');
      collapse.addEventListener('click', function() {
          radio.checked = radio.checked == true ? false : true;
      });
  });
});

// brands
var brands = new Swiper(".brandsSwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  autoplay: {
    delay: 2000
  },
  loop: true,
  breakpoints: {
    "@0.00": {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    "@1.00": {
      slidesPerView: 4,
      spaceBetween: 40,
    },
    "@1.50": {
      slidesPerView: 6,
      spaceBetween: 50,
    },
  },
});