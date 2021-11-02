<template>
   <div>
    <categories :categories="categories" />
   </div>
</template>

<script>
import { mapGetters } from "vuex";
import Categories from '~/components/home/Categories';
  export default {
    name: 'all-categories',
    waitForMe: true,
    middleware: 'auth',
    components: { Categories },
    methods: {
     async fetchAllCategories() {
      // if the categories is already loaded in vuex, show the categories instantly and don't wait for the request to be finished.
      if (this.categories.length) {
        this.$store.dispatch("general/changeWait", { wait: false });
        this.$store.dispatch("home/fetchAllCategories");
      } else {
        await this.$store.dispatch("home/fetchAllCategories");
        this.$store.dispatch("general/changeWait", { wait: false });
      }
    },
  },
   created() {
    this.fetchAllCategories();
  },
  metaInfo() {
    return { title: this.$t('Categories') };
  },

  data: () => ({
    title: window.config.appName,
  }),

  computed: mapGetters({
    categories: "home/allCategories",
  }), 
  }
</script>

<style scoped>

</style>