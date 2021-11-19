<template>
  <div>
    <!-- restaurent top -->
    <section class="section-padding restaurent-about smoothscroll" id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-4 place-img">
            <img :src="place.details.image" class="img-fluid full-height full-width" alt="#" />
          </div>
          <div class="col-md-8">
            
            <h3 class="text-light-black fw-700 title">
              {{ locale == 'ar' ? place.details.name_ar : place.details.name_en }}
              <a v-if="place.details.my_place" v-b-modal.editPlaceModal class="btn btn-dark edit-place-modal-btn" href="javascript:void(0)" >{{ $t('Edit your data') }}</a>
              <edit-place-modal v-if="modalReady" :place="place.details" />
            </h3>

            <p class="text-light-white no-margin">
              {{ locale == 'ar' ? place.details.description_ar : place.details.description_en }}
            </p>
           <icons :place="place.details" />
          </div>
        </div>
      </div>
    </section>
    <!-- restaurent top -->

    <!-- restaurent tab -->
    <div class="restaurent-tabs u-line">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="restaurent-menu scrollnav">
              <ul class="nav nav-pills">
                <li class="nav-item" v-for="tab in tabs" :key="tab.name">
                  <a
                    class="nav-link text-light-white fw-700"
                    data-toggle="pill"
                    @click.prevent="setActive(tab.name)"
                    :class="{ active: isActive(tab.name) }"
                    :href="`#${tab.name}`"
                    >{{ tab.title }}</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- restaurent tab -->

    <!-- restaurent tab content -->
    <div class="tab-content py-3">
      <!-- services -->
      <section :class="{ 'active show': isActive(tabs[0].name) }" :id="tabs[0].name" class="tab-pane fade section-padding restaurent-meals bg-light-theme">
        <services :infos="place.services" :myPlace="place.details.my_place" :place_id="place.details.id" :title="tabs[0].title" />
      </section>
      <!-- services -->

      <!-- products -->
      <section :class="{ 'active show': isActive(tabs[1].name) }" :id="tabs[1].name" class="tab-pane fade section-padding restaurent-meals bg-light-theme">
        <products :infos="place.products" :myPlace="place.details.my_place" :place_id="place.details.id" :title="tabs[1].title" />
      </section>
      <!-- products -->

      <!-- offers -->
      <section :class="{ 'active show': isActive(tabs[2].name) }" :id="tabs[2].name" class="tab-pane fade section-padding restaurent-meals bg-light-theme">
        <offers :infos="place.offers" :myPlace="place.details.my_place" :place_id="place.details.id" :title="tabs[2].title" />
      </section>
      <!-- offers -->

      <!-- about -->
      <section :class="{ 'active show': isActive(tabs[3].name) }" :id="tabs[3].name" class="tab-pane fade section-padding restaurent-meals bg-light-theme">
        <!-- <about :infos="place.aboutus" :title="tabs[3].title" /> -->
        <about :infos="[{id:1,details_ar:place.details.description_ar,details_en:place.details.description_en,}]" :title="tabs[3].title" />
      </section>
      <!-- about -->
    </div>
    <!-- restaurent tab content -->
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import About from '~/components/place/About.vue';
import Offers from '~/components/place/Offers.vue';
import Products from '~/components/place/Products.vue';
import Services from '~/components/place/Services.vue';
import Icons from '~/components/place/Icons.vue';
import EditPlaceModal from '~/components/place/EditPlaceModal.vue';

export default {
  components: { About,Offers,Products,Services, Icons, EditPlaceModal },
  waitForMe: true,
  middleware: "auth",
  props: ["id"],
  // this.$route.params.id
  methods: {
    async fetchPlace(id) {
      await this.$store.dispatch("place/fetchPlace", { id: id });
      this.$store.dispatch("general/changeWait", { wait: false });
    },
    isActive(menuItem) {
      return this.activeItem === menuItem;
    },
    setActive(menuItem) {
      this.activeItem = menuItem;
    },
  },
  async created() {
    await this.fetchPlace(this.id);
    this.modalReady = true; // to let place fully loaded from the store
  },
  metaInfo() {
    let title = this.locale == 'ar' ? this.place.details.name_ar : this.place.details.name_en
    return { title: title };
  },
  data() {
    let tabs = [
      {
        name: "services",
        title: this.$t('Services'),
      },
      {
        name: "products",
        title: this.$t('Products'),
      },
      {
        name: "offers",
        title: this.$t('Offers'),
      },
      {
        name: "aboutus",
        title: this.$t('About us'),
      },
    ];

    return {
      title: window.config.appName,
      tabs: tabs,
      modalReady: false,
      activeItem: tabs[0].name,
    };
  },
  computed: {
    ...mapGetters({
    place: "place/place",
    locale: "lang/locale"
  }),
  }
};
</script>

<style>
.restaurent-offer-caption-box {
  display: flex;
  justify-content: space-between;
  width: 100%;
  flex-wrap: wrap;
  align-self: flex-start;
  background: #eee;
  padding: 15px;
  border-radius: 10px;
}
.restaurent-offer-caption-box .offer-code,
.restaurent-offer-caption-box .offer-code {
  margin: 0;
}
.restaurent-product-caption-box,
.restaurent-tags-price {
  margin-right: 15px;
}

@media (max-width: 768px){
  .place-img {
      margin-bottom: 3rem!important;
  }
}
</style>
