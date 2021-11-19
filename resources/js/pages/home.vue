<template>
  <div class="container-fluid file">
    <file-manager></file-manager>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  middleware: 'auth',
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

<style scoped>
.file{
  height: 800px;
}
.file *{
  direction: ltr;
  text-align: left;
}
</style>