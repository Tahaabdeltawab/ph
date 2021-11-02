import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    home: {
        sliders: [],
        categories: [],
        populars: [],
        // subcategories: [],
    },
    allCategories: [],
    info: {
        agreement: [],
        privacy: [],
    },
}

// getters
export const getters = {
    home: state => state.home,
    allCategories: state => state.allCategories,
    info: state => state.info,
}

// mutations
export const mutations = {
    [types.FETCH_HOME_SUCCESS](state, { home }) {
        state.home.sliders = home.Slider || state.home.sliders
        state.home.categories = home.all_category || state.home.categories
        state.home.populars = home.popular_section || state.home.populars
            // state.subcategories = home.subcategory || state.subcategories
    },
    [types.FETCH_ALL_CATEGORIES_SUCCESS](state, { allCategories }) {
        state.allCategories = allCategories;
    },
    [types.FETCH_AGREEMENT_SUCCESS](state, { agreement }) {
        state.info.agreement = agreement;
    },
    [types.FETCH_PRIVACY_SUCCESS](state, { privacy }) {
        state.info.privacy = privacy;
    },
}

// actions
export const actions = {
    async fetchHome({ commit }, { area_id, needs }) {
        try {
            let params = {};
            if (area_id)
                params['area_id'] = area_id
            if (needs)
                params['needs'] = needs
            const { data } = await axios.get('/api/Home', { params: params })
            commit(types.FETCH_HOME_SUCCESS, { home: data.data })
        } catch (e) {
            // commit(types.FETCH_HOME_FAILURE)
        }
    },
    async fetchAllCategories({ commit }) {
        try {
            const { data } = await axios.get('/api/show_all_subCategory')
            commit(types.FETCH_ALL_CATEGORIES_SUCCESS, { allCategories: data.data })
        } catch (e) {}
    },
    async fetchAgreement({ commit }) {
        try {
            const { data } = await axios.get('/api/show_usageAgreement')
            commit(types.FETCH_AGREEMENT_SUCCESS, { agreement: data.data })
        } catch (e) {}
    },
    async fetchPrivacy({ commit }) {
        try {
            const { data } = await axios.get('/api/show_privacyPolicy')
            commit(types.FETCH_PRIVACY_SUCCESS, { privacy: data.data })
        } catch (e) {}
    },
}