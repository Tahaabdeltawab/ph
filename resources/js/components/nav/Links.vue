<template>
  <ul class="navbar-nav ml-auto mr-3 mt-2 mt-lg-0">
    <li class="nav-item" :class="{active: this.routeName == 'welcome'}">
      <router-link class="nav-link" :to="{name:'welcome'}">{{$t('Home')}}</router-link>
    </li>
    <li class="nav-item" :class="{active: this.routeName == 'categories'}">
      <router-link class="nav-link" :to="{name:'categories'}">{{$t('Categories')}}</router-link>
    </li>
    <li class="nav-item" :class="{active: this.routeName == 'favorites'}">
      <router-link class="nav-link" :to="{name:'favorites'}">{{$t('Favorites')}}</router-link>
    </li>
  </ul>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: mapGetters({
    routeName: "general/routeName",
  }),
};
</script>
<style scoped>
li,
a {
  text-align: right;
}
</style>