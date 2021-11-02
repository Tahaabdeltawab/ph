import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'


Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    i18n,
    store,
    router,
    ...App
})

// laravel-vue-file-manager

import FileManager from 'laravel-file-manager'
Vue.use(FileManager, { store })

// end laravel-vue-file-manager

//laravel-video-chat
/*

import VueChatScroll from 'vue-chat-scroll';
import VueTimeago from 'vue-timeago';

require('webrtc-adapter');
window.Cookies = require('js-cookie');

import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

Vue.use(VueChatScroll);
Vue.component('chat-room', require('~/components/laravel-video-chat/ChatRoom.vue'));
Vue.component('group-chat-room', require('~/components/laravel-video-chat/GroupChatRoom.vue'));
Vue.component('video-section', require('~/components/laravel-video-chat/VideoSection.vue'));
// Vue.component('file-preview', require('~/components/laravel-video-chat/FilePreview.vue'));

Vue.use(VueTimeago, {
    name: 'timeago', // component name, `timeago` by default
    locale: 'en-US',
    locales: {
        // 'en-US': require('vue-timeago/locales/en-US.json')
    }
})
*/
//ebd laravel-video-chat