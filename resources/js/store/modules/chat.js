import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    groups: [],
    conversations: [],
}

// getters
export const getters = {
    groups: state => state.groups,
    conversations: state => state.conversations,
}

// mutations
export const mutations = {
    [types.FETCH_CONVERSATIONS_SUCCESS](state, { data }) {
        state.groups = data.groups,
            state.conversations = data.conversations
    },
}

// actions
export const actions = {
    async fetchConversations({ commit }) {
        try {
            const { data } = await axios.get('/api/conversations')
            console.log(data);
            commit(types.FETCH_CONVERSATIONS_SUCCESS, { data: data.data })
        } catch (e) {}
    },
}