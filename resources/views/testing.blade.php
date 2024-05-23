<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    .swiper {
}
</style>
</head>
<body>
    <div class=" swiper myswiper w-fit">
        <div class="swiper-wrapper w-fit">
            <!-- Slides -->
            <div class="swiper-slide rounded-box w-fit">
                <img src="{{ Storage::url('public/sliders/a.jpg') }}" class="w-full"
                    alt="Tailwind CSS Carousel component" />

            </div>
            <div class="swiper-slide rounded-box">
                <img src="{{ Storage::url('public/sliders/b.jpg') }}" class="w-full"
                    alt="Tailwind CSS Carousel component" />

            </div>
            <div class="swiper-slide rounded-box">
                <img src="{{ Storage::url('public/sliders/c.jpg') }}" class="w-full"
                    alt="Tailwind CSS Carousel component" />

            </div>
            <div class="swiper-slide rounded-box">
                <img src="{{ Storage::url('public/sliders/b.jpg') }}" class="w-full"
                    alt="Tailwind CSS Carousel component" />

            </div>
            <div class="swiper-slide rounded-box">
                <img src="{{ Storage::url('public/sliders/b.jpg') }}" class="w-full"
                    alt="Tailwind CSS Carousel component" />

            </div>
            <div class="swiper-slide rounded-box">
                <img src="{{ Storage::url('public/sliders/b.jpg') }}" class="w-full"
                    alt="Tailwind CSS Carousel component" />

            </div>
        </div>
    </div>
</body>

<script>
    const swiper = new Swiper('.swiper', {
        effect: 'cube',
  // Optional parameters
  loop: true,

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
</script>
</html>