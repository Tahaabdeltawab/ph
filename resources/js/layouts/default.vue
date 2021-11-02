<template>
  <div class="main-layout">

    <navbarq-2 />
    
    <div>
      <child />
    </div>

    <footerq />

  </div>
</template>

<script>
import Footerq from "~/components/Footerq";
import Navbarq2 from '~/components/Navbarq2.vue';

export default {
  name: "MainLayout",

  components: {
    Footerq,
    Navbarq2,
  },
};
</script>
