<template>
  <section class="active show tab-pane fade section-padding restaurent-meals bg-light-theme">
    <about :infos="info.agreement" :title="$t('Usage Agreement')" />
  </section>
</template>

<script>
import { mapGetters } from "vuex";
import About from '~/components/place/About.vue';

  export default {
    components: { About },
    name: 'agreement',
    waitForMe: true,
    middleware: 'auth',
    methods: {
      async fetchAgreement() {
        if (this.info.agreement.length) {
          this.$store.dispatch("general/changeWait", { wait: false });
          await this.$store.dispatch("home/fetchAgreement");
        } else {
          await this.$store.dispatch("home/fetchAgreement");
          this.$store.dispatch("general/changeWait", { wait: false });
        }
      },
    },
    async created() {
      await this.fetchAgreement();
    },
    metaInfo() {
      return { title: this.$t('Usage Agreement') };
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