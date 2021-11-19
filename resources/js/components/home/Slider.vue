<template>
  <div class="container-fluid">
    <!-- slider -->
    <section class="about-us-slider swiper-container p-relative">
      <swiper :options="swiperOptions">
        <swiper-slide v-for="slider in sliders" :key="slider.id" class="swiper-slide slide-item">
          <img
            :src="slider.image"
            class="img-fluid full-width"
            alt="Banner"
          />
          <!-- <div class="overlay overlay-bg"></div> -->
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
        <div class="swiper-button-next" slot="button-next"></div>
        <div class="swiper-button-prev" slot="button-prev"></div>
        
      </swiper>
    </section>
    <!-- slider -->
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
import "swiper/css/swiper.min.css";

export default {
  name: "Slider",
  props: ["sliders"],
  data() {
    return {
      swiperOptions: {
        pagination: {
          el: ".swiper-pagination",
        },
        loop: true,
        speed: 800,
        initialSlide: 0,
        autoplay: {
          delay: 3500,
          stopOnLastSlide: false,
          // disableOnInteraction: true
        },
        // slidesPerView: "auto",
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        }, 
      },
    };
  },
    components: {
    Swiper,
    SwiperSlide,
  },
};
</script>

<style scoped>
.container-fluid{
  padding: 0 !important;
}
.swiper-button-next, .swiper-button-prev {
    width: 30px!important;
    height: 30px!important;
}
.swiper-button-next::after, .swiper-button-prev::after {
    font-size: 15px!important;
}

.about-us-slider .slide-item img {
    object-fit: fill;
}
.about-us-slider .slide-item {
    height: 450px;
}
@media (max-width: 564px){
  .about-us-slider .slide-item {
      height: 300px;
  }
}
</style>