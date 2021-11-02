import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    cities: [],
    areas: [],
}

// getters
export const getters = {
    cities: state => state.cities,
    areas: state => state.areas,
}

// mutations
export const mutations = {
    [types.FETCH_CITIES_SUCCESS](state, { cities }) {
        state.cities = cities
    },
    [types.FETCH_AREAS_SUCCESS](state, { areas }) {
        state.areas = areas
    },
}

// actions
export const actions = {
    async fetchCities({ commit }) {
        try {
            const { data } = await axios.get('/api/show_all_city')
            console.log(data.data);
            commit(types.FETCH_CITIES_SUCCESS, { cities: data.data })
        } catch (e) {
            // commit(types.FETCH_CITIES_SUCCESS)
        }
    },
    async fetchCityAreas({ commit }, { city_id }) {
        try {
            const { data } = await axios.get('/api/show_Area_byCityId?city_id=' + city_id)
            console.log(data.data);
            commit(types.FETCH_AREAS_SUCCESS, { areas: data.data })
        } catch (e) {
            // commit(types.FETCH_AREAS_SUCCESS)
        }
    },
}