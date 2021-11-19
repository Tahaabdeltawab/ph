<template>
  <!-- Navigation -->
      <div class="header2 container-fluid">
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark" dir="rtl"> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white" dir="rtl">
        <router-link
          :to="{ name: 'welcome' }"
          class="navbar-brand"
        >
           <img :src="asset('uploads/Logo.png')" class="img-fluid nav-logo" alt="app logo" />
        </router-link>
        <router-link :to="{ name: 'home' }" class="navbar-brand">home</router-link>
        <router-link :to="{ name: 'universities' }" class="navbar-brand">univs</router-link>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbar"
        >
          <span class="navbar-toggler-icon" />
        </button>

        <div id="navbar" class="collapse navbar-collapse">
          
          <!-- navigation links -->
          <links />
          <!-- navigation links -->
          
          <!-- search -->
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" :placeholder="$t('Search')">
            <button class="btn btn-brand search-button my-2 my-sm-0" type="submit"> <b-icon icon="search" fixed-width></b-icon></button>
          </form>
          <!-- search -->

          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            
            <!-- locale -->
            <locale-dropdown />
            <!-- locale -->

            <template v-if="user">
              <!-- modal -->
              <a v-b-modal.locationModal class="nav-item btn location-modal-btn" >{{locale == 'ar' ? user.area_name_ar : user.area_name_en}}</a>
              <location-modal />
              <!-- modal -->
              
              <!-- notification -->
              <notifications-dropdown />
              <!-- notification -->  
            </template>
            
            <auth />
          </ul>
        </div>
    </nav>
        </div>
  <!-- Navigation -->
</template>

<script>
import { mapGetters } from "vuex";
import Auth from './nav/Auth.vue';
import Links from './nav/Links.vue';
import LocaleDropdown from "./nav/LocaleDropdown";
import NotificationsDropdown from "./nav/NotificationsDropdown";
import LocationModal from "./nav/LocationModal";

export default {
  components: {
    LocaleDropdown,
    NotificationsDropdown,
    LocationModal,
    Auth,
    Links,
  },

  data: () => ({
    appName: window.config.appName,
  }),
  computed: mapGetters({
    user: "auth/user",
    locale: "lang/locale",
  }),
  methods: {
    async logout() {
      // Log out the user.
      await this.$store.dispatch("auth/logout");

      // Redirect to login.
      this.$router.push({ name: "login" });
    },
  },
};
</script>
<style >
*{
  text-align: right;
}
.container {
  max-width: 1100px;
}

.header2{
  position: relative;
  left: 0;
  z-index: 10;
  width: 100%;
  height: 60px;
  transform: translateZ(0);
  transition: all .2s ease;
  box-shadow: 0 0 0 1px rgb(67 41 163 / 10%), 0 1px 8px 0 rgb(67 41 163 / 10%);
}
.container-fluid{
  padding: 0 !important;
}
.location-modal-btn {
  margin-left:3px;
  cursor: pointer;
}

.nav-item.active .nav-link {
  border-bottom: 3px solid #222;
}

.nav-logo {
  height: 45px;
}
</style>
