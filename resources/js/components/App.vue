<template>
  <div id="app">
    <loading ref="loading" />
    <transition name="page" mode="out-in">
      <!-- <component :is="layout" v-if="layout" /> -->
      <!-- <component v-show="!wait" :is="layout" v-if="layout" /> --> <!-- create right margin --> 
      <!-- <component :style="{visibility: wait ? 'hidden' : 'visible'}" :is="layout" v-if="layout" /> -->
      <component :style="{opacity: wait ? 0 : 1}" :is="layout" v-if="layout" class="wow animate__animated animate__fadeIn" />
    </transition>
     <!-- <h1 style="color:red; position:fixed; top:110px; right:0; z-index:111111">
      {{wait ? 'wait true' : 'wait false'}}
    </h1> -->
  </div>
</template>

<script>
import Loading from "./Loading";
import { mapGetters } from 'vuex'

// Load layout components dynamically.
const layoutsReducer = (components, [name, component]) => {
  components[name] = component.default || component;
  return components;
};
const requireContext = require.context("~/layouts", false, /.*\.vue$/);

const layouts = requireContext
  .keys()
  .map((file) => [file.replace(/(^.\/)|(\.vue$)/g, ""), requireContext(file)])
  .reduce(layoutsReducer, {});

export default {
  el: "#app",

  components: {
    Loading,
  },

  data: () => ({
    layout: null,
    defaultLayout: "default",
  }),
  computed: {
    ...mapGetters({
      wait: 'general/wait',
    }),
  },
  metaInfo() {
    const { appName } = window.config;

    return {
      title: appName,
      titleTemplate: `%s · ${appName}`,
    };
  },

  mounted() {
    this.$loading = this.$refs.loading;
  },

  methods: {
    /**
     * Set the application layout.
     *
     * @param {String} layout
     */
    // the layout is coming from any pageComponent.layout prop or the default layout 'default' see home.vue {layout: basic}
    // this method is called from router/index.js line 84
    setLayout(layout) {
      if (!layout || !layouts[layout]) {
        layout = this.defaultLayout;
      }

      this.layout = layouts[layout];
    },
  },
};
</script>
