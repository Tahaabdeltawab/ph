<template>
  <section class="active show tab-pane fade section-padding restaurent-meals bg-light-theme">
    <about :infos="info.privacy" :title="$t('Privacy Policy')" />
  </section>
</template>

<script>
import { mapGetters } from "vuex";
import About from "~/components/place/About.vue";
  export default {
  components: { About },
    name: 'privacy',
    waitForMe: true,
    middleware: 'auth',
  methods: {
    async fetchPrivacy() {
      if (this.info.privacy.length) {
        this.$store.dispatch("general/changeWait", { wait: false });
        await this.$store.dispatch("home/fetchPrivacy");
      } else {
        await this.$store.dispatch("home/fetchPrivacy");
        this.$store.dispatch("general/changeWait", { wait: false });
      }
    },
  },
  async created() {
    await this.fetchPrivacy();
  },
  metaInfo() {
    return { title: this.$t('Privacy Policy') };
  },

  data: () => ({
    title: window.config.appName,
  }),

  computed: mapGetters({
    info: "home/info",
  }),
  }
</script>

<style scoped>

</style>