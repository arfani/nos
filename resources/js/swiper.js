// import Swiper JS
import Swiper from 'swiper';
import { Autoplay, EffectCards, Navigation, Thumbs, EffectCoverflow, EffectCube } from 'swiper/modules';
// import Swiper styles
import 'swiper/css/bundle';

Swiper.use([Autoplay, EffectCards, Thumbs, Navigation, EffectCoverflow, EffectCube]);

const heroSwiper = new Swiper('.heroSwiper', {
  autoplay: true,
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
  autoplay: { delay: 1000 },
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
