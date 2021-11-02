<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <file-manager></file-manager>


    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  middleware: 'auth',
  methods: {

  },
  async created() {
  },
  metaInfo () {
    return { title: this.$t('home') }
  },
  computed: {
    ...mapGetters({
    user: "auth/user"
  }),
  }
}
</script>
