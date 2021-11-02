<template>
  <div>
      <card :title="$t('home')">
        <a href="#" @click.prevent="startConversation(18)">Start Conversation</a>
          <ul class="list-group">
                <li v-for="conversation in conversations" :key="conversation.id" class="list-group-item">
                <chat-room :conversation="conversation" :current-user="user"></chat-room>
                <template v-if="conversation.is_accepted">
                    <a href="#">
                        <h2>{{conversation.user.username}}</h2>
                        <span v-if="conversation.message">{{ conversation.message.text}}</span>
                    </a>
                </template>
                <template v-else>
                    <a href="#">
                        <h2>{{conversation.user.username}}</h2>
                            <a v-if="conversation.second_user_id == user.id" @click.prevent="acceptConversation(conversation.id)" class="btn btn-xs btn-success">
                                Accept Message Request
                            </a>
                    </a>
                </template>
                </li>

                <li v-for="group in groups" :key="group.id" class="list-group-item">
                    <a href="#">
                        <h2>{{group.name}}</h2>
                        <span>{{ group.users_count }} Member</span>
                    </a>
                </li>
        </ul>
      </card>
  </div>
</template>

<script>

import axios from "axios";
import ChatRoom from '~/components/laravel-video-chat/ChatRoom.vue'
import { mapGetters } from "vuex";

export default {
  components: { ChatRoom },
  middleware: 'auth',
  methods: {
    async fetchConversations() {
      await this.$store.dispatch("chat/fetchConversations");
      this.$store.dispatch("general/changeWait", { wait: false });
    },
    async startConversation(otherUserId){
      const { data } = await axios.get(`/api/start-conversation/${otherUserId}`)
    },
    async acceptConversation(conversationId){
      const { data } = await axios.get(`/api/accept-conversation/${conversationId}`)
    },
    async sendMessage(conversationId, message){
      const { data } = await axios.get(`/api/send-message/${conversationId}`, {params : {message : message}})
    },
    async getConversationMessages(conversationId){
      const { data } = await axios.get(`/api/send-message/${conversationId}`)
    },
  },
  async created() {
    await this.fetchConversations();
  },
  metaInfo () {
    return { title: this.$t('home') }
  },
  computed: {
    ...mapGetters({
    user: "auth/user",
    groups: "chat/groups",
    conversations: "chat/conversations",
  }),
  }
}

</script>

<style scoped>

</style>