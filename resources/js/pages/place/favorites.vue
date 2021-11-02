<template>
  <div>
   <places-listing :places="favorites" />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import PlacesListing from '~/components/place/PlacesListing.vue';
export default {
  waitForMe: true,
  components: { PlacesListing },
  middleware: "auth",
  props: ["id"],
  // this.$route.params.id
  methods: {
    async fetchFavorites(id) {
      await this.$store.dispatch("place/fetchFavorites");
      this.$store.dispatch("general/changeWait", { wait: false });
    },
  },
  async created() {
    await this.fetchFavorites();
  },
  metaInfo() {
    return { title: this.$t('Favorites') };
  },
  data() {
    return {
      title: window.config.appName,
    };
  },
  computed: mapGetters({
    favorites: "place/favorites",
  }),
};
</script>