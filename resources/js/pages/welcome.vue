<template>
<!-- v-if="home.sliders.length" -->
  <div  class="wow animate__animated animate__fadeIn">
    <slider :sliders="home.sliders" class="wow animate__animated animate__fadeIn" />
    <category-slider :categories="home.categories" />
    <popular :populars="home.populars" />
    <hr style="margin:0; border-top:1px solid rgba(0,0,0,0.15)">
    <categories :categories="home.categories" />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Slider from "~/components/home/Slider";
import CategorySlider from "~/components/home/CategorySlider";
import Popular from "~/components/home/Popular";
import Categories from "~/components/home/Categories";

export default {
  name: 'welcome',
  // layout: 'basic',
  // waitForMe: true => indicates this page should await for a request before rendering. Here the request is fetchHome(). this requires a way to disable the wait after the request finishes which is this.$store.dispatch("general/changeWait", { wait: false });
  // waitForMe: true,
  // middleware: "auth",
  components: {
    Slider,
    CategorySlider,
    Popular,
    Categories,
  },
  methods: {
    async fetchHome() {
      // if the home is already loaded in vuex, show the home instantly and don't wait for the request to be finished.
      // if (this.home.sliders.length) { // routing
        // this.$store.dispatch("general/changeWait", { wait: false });
        await this.$store.dispatch("home/fetchHome", this.user ? {area_id: this.user.area_id,} : {});
      // } else { // page reload
        // await this.$store.dispatch("home/fetchHome", this.user ? {area_id: this.user.area_id,} : {});
        // this.$store.dispatch("general/changeWait", { wait: false });
      // }
    },
  },
  async created() {
    await this.fetchHome();
  },
  metaInfo() {
    return { title: this.$t('Home') };
  },

  data: () => ({
    title: window.config.appName,
  }),

  computed: mapGetters({
    user: "auth/user",
    home: "home/home",
  }),
};
</script>

<style>
.swiper-button-next::after,
.swiper-button-prev::after {
  font-size: 15px !important;
}
.swiper-button-next,
.swiper-button-prev {
  width: 30px !important;
  height: 30px !important;
}
.section-padding {
  padding: 40px 0;
}

.container {
  max-width: 1350px;
}
</style>
