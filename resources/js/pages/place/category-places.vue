<template>
  <div>
   <places-listing :places="categoryPlaces" />
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
    async fetchCategoryPlaces(id) {
      await this.$store.dispatch("place/fetchCategoryPlaces", {id});
      this.$store.dispatch("general/changeWait", { wait: false });
    },
  },
  async created() {
    await this.fetchCategoryPlaces(this.id);
  },
  metaInfo() {
    return { title: this.$t('Category') };
  },
  data() {
    return {
      title: window.config.appName,
    };
  },
  computed: mapGetters({
    categoryPlaces: "place/categoryPlaces",
  }),
};
</script>