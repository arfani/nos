// import Swiper JS
import Swiper from 'swiper';
import { FreeMode } from 'swiper/modules';
// import Swiper styles
import 'swiper/css/bundle';

Swiper.use([FreeMode]);

var swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});

var swiper2 = new Swiper(".mySwiper2", {
    spaceBetween: 10,
    thumbs: {
        swiper: swiper,
    },
});
