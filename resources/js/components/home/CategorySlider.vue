<template>
  <!-- Browse by category -->
  <section class="browse-cat u-line section-padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-header-left">
            <h3 class="text-light-black header-title title">
              {{$t('Categories')}}
              <span class="fs-14"><router-link :to="{name: 'categories'}">{{$t('See all')}}</router-link></span>
            </h3>
          </div>
        </div>
        <swiper :options="swiperOptions"
        >
          <swiper-slide v-for="category in categories" :key="category.id" class="swiper-slide slide-item tab">
            <router-link :to="{ name: 'category', params: { id: category.id } }" class="tablinks slide active">
              <span>
                <img :src="category.sub_image" class="img-responsive" alt="image">
                {{locale == 'ar' ? category.name_ar : category.name_en}}
              </span>
            </router-link>
          </swiper-slide>
          <div class="swiper-button-next" slot="button-next"></div>
          <div class="swiper-button-prev" slot="button-prev"></div>
        </swiper>
      </div>
    </div>
  </section>
  <!-- Browse by category -->
</template>

<script>
import { mapGetters } from 'vuex'
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
import "swiper/css/swiper.min.css";

export default {
  name: "Slider",
  computed: mapGetters({
    locale: 'lang/locale',
  }),
  props: ["categories"],
  data() {
    return {
      swiperOptions: {
        loop: true,
        // speed: 800,
        initialSlide: 0,
        autoplay: {
          delay: 5000,
          stopOnLastSlide: false,
          disableOnInteraction: true,
        },
        slidesPerView: 8,
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
.container-fluid {
  padding: 0 !important;
}
.swiper-button-next,
.swiper-button-prev {
  width: 30px !important;
  height: 30px !important;
}
.swiper-button-next::after,
.swiper-button-prev::after {
  font-size: 15px !important;
}
.browse-cat .categories .cat-name {
  display: inline-block!important;
}

.tab {
  width: auto!important;
}
.tab .tablinks:hover {
  background: rgba(0, 0, 0, .7);
  color: #fff;
  transition: 0.1s !important;
}
.tab .tablinks {
  background-color: #eee;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 13px 24px;
  transition: 0.1s !important;
  font-size: 15px;
  font-weight: 600;
  margin: 5px;
  text-align: center;
  font-size: 15px;
  color: #141515;
  border-radius: 40px;
  min-width: 75px;
  direction: rtl;
}
.tab .tablinks img {
  width: 24px!important;
}
</style>