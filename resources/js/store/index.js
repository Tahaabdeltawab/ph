import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

// Load store modules dynamically.
const modulesReducer = (modules, [name, module]) => {
    if (module.namespaced === undefined) {
        module.namespaced = true
    }
    return {...modules, [name]: module }
}

const requireContext = require.context('./modules', false, /.*\.js$/)
const modules = requireContext.keys()
    .map(file => [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)])
    .reduce(modulesReducer, {})

export default new Vuex.Store({
    modules
})