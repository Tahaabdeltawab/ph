import * as types from '../mutation-types'

// state
export const state = {
    wait: false,
    routeName: '',
}

// getters
export const getters = {
    wait: state => state.wait,
    routeName: state => state.routeName,
}

// mutations
export const mutations = {
    [types.CHANGE_WAIT](state, { wait }) {
        state.wait = wait
    },
    [types.CHANGE_ROUTE_NAME](state, { routeName }) {
        state.routeName = routeName
    },
}

// actions
export const actions = {
    changeWait({ commit }, { wait }) {
        try {
            commit(types.CHANGE_WAIT, { wait })
        } catch (e) {}
    },
    changeRouteName({ commit }, { routeName }) {
        try {
            commit(types.CHANGE_ROUTE_NAME, { routeName })
        } catch (e) {}
    },
}