import Vue from 'vue'
import Card from './Card.vue'
import Child from './Child.vue'
import Button from './Button.vue'
import Checkbox from './Checkbox.vue'
import { HasError, AlertError, AlertSuccess } from 'vform/components/bootstrap5'

// Components that are registered globaly.
[
    Card,
    Child,
    Button,
    Checkbox,
    HasError,
    AlertError,
    AlertSuccess
].forEach(Component => {
    Vue.component(Component.name, Component)
})


import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// Make BootstrapVue available throughout your project
// Optionally install the BootstrapVue icon components plugin
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


Vue.mixin({
    methods: {
        asset(url) {
            return window.config.asset + url;
        },
    }
})