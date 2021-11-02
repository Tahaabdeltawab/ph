import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'

// state
export const state = {
    user: null,
    token: Cookies.get('token'),
    notifications: [],
}

// getters
export const getters = {
    user: state => state.user,
    token: state => state.token,
    check: state => state.user !== null,
    notifications: state => state.notifications,
}

// mutations
export const mutations = {
    [types.SAVE_TOKEN](state, { token, remember }) {
        state.token = token
        Cookies.set('token', token, { expires: remember ? 365 : null })
    },

    [types.FETCH_USER_SUCCESS](state, { user }) {
        state.user = user
    },

    [types.FETCH_USER_FAILURE](state) {
        state.token = null
        Cookies.remove('token')
    },

    [types.LOGOUT](state) {
        state.user = null
        state.token = null

        Cookies.remove('token')
    },

    [types.UPDATE_USER](state, { user }) {
        state.user = user
    },

    [types.FETCH_NOTIFICATIONS_SUCCESS](state, { notifications }) {
        state.notifications = notifications
    }
}

// actions
export const actions = {
    saveToken({ commit, dispatch }, payload) {
        commit(types.SAVE_TOKEN, payload)
    },

    async fetchUser({ commit }, payload = null) {
        try {
            let user = null;
            if (payload == null) {

                const { data } = await axios.get('/api/user')
                user = data.data;
            } else {
                user = payload.user;
            }
            commit(types.FETCH_USER_SUCCESS, { user })
        } catch (e) {
            commit(types.FETCH_USER_FAILURE)
        }
    },
    async fetchNotifications({ commit }) {
        console.log('before call notifs api');
        try {
            const { data } = await axios.get('/api/show_all_notification')
            let notifications = data.data;
            commit(types.FETCH_NOTIFICATIONS_SUCCESS, { notifications })
        } catch (e) {}
    },

    updateUser({ commit }, payload) {
        commit(types.UPDATE_USER, payload)
    },

    async updateUserLocation({ commit }, { city_id, area_id }) {
        try {
            const { data } = await axios.get('/api/update_CityArea?city_id=' + city_id + '&area_id=' + area_id)
            let payload = { user: data.data };
            commit(types.UPDATE_USER, payload)
        } catch (e) {
            // commit(types.UPDATE_USER)
        }
    },

    async logout({ commit }) {
        try {
            await axios.post('/api/logout')
        } catch (e) {}

        commit(types.LOGOUT)
    },

    async fetchOauthUrl(ctx, { provider }) {
        const { data } = await axios.post(`/api/oauth/${provider}`)

        return data.url
    }
}