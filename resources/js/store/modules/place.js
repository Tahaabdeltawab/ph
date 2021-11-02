import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    place: {
        details: {},
        products: [],
        services: [],
        offers: [],
        aboutus: [],
    },
    categoryPlaces: [],
    favorites: [],
}

// getters
export const getters = {
    place: state => state.place,
    categoryPlaces: state => state.categoryPlaces,
    favorites: state => state.favorites,
}

// mutations
export const mutations = {
    // place
    [types.FETCH_PLACE_SUCCESS](state, { place }) {
        state.place.details = place.place_details
        state.place.details.isFavorite = place.place_details.isFavorite === "true"
        state.place.products = place.products
        state.place.services = place.place_services
        state.place.offers = place.offers
        state.place.aboutus = place.aboutUs
    },
    [types.TOGGLE_FAV_SUCCESS](state) {
        state.place.details.isFavorite = !state.place.details.isFavorite;
    },
    [types.UPDATE_PLACE_SUCCESS](state, { place }) {
        place.keys().forEach(key => {
            state.place.details[key] = place[key]
        })
    },
    [types.ADD_PLACE_SERVICE_SUCCESS](state, { service }) {
        state.place.services.push(service)
    },
    [types.ADD_PLACE_PRODUCT_SUCCESS](state, { product }) {
        state.place.products.push(product)
    },
    [types.ADD_PLACE_OFFER_SUCCESS](state, { offer }) {
        state.place.offers.push(offer)
    },

    // category
    [types.FETCH_CATEGORY_PLACES_SUCCESS](state, { categoryPlaces }) {
        state.categoryPlaces = categoryPlaces.map(function(categoryPlace) {
            categoryPlace.isFavorite = categoryPlace.isFavorite === "true";
            return categoryPlace;
        });

    },
    [types.TOGGLE_FAV_CATEGORY_PLACE_SUCCESS](state, { id }) {
        state.categoryPlaces = state.categoryPlaces
            .map(function(categoryPlace) {
                if (categoryPlace.id == id)
                    categoryPlace.isFavorite = !categoryPlace.isFavorite;
                return categoryPlace;
            });
    },

    // favorites
    [types.FETCH_FAVORITE_PLACES_SUCCESS](state, { favorites }) {
        state.favorites = favorites.map(function(favorite) {
            favorite.isFavorite = favorite.isFavorite === "true";
            return favorite;
        });
    },
    [types.TOGGLE_FAV_FAVORITE_PLACE_SUCCESS](state, { id }) {
        state.favorites = state.favorites
            .filter(function(favorite) {
                return favorite.id != id
            });
    },
}

// actions
export const actions = {
    // place
    async fetchPlace({ commit }, { id }) {
        try {
            const { data } = await axios.get('/api/show_place_details?place_id=' + id)
            commit(types.FETCH_PLACE_SUCCESS, { place: data.data })
        } catch (e) {}
    },
    async toggleFav({ commit }, { id }) {
        try {
            // commit(types.TOGGLE_FAV_SUCCESS)
            await axios.get('/api/add_favorite?place_id=' + id)
            commit(types.TOGGLE_FAV_SUCCESS)
        } catch (e) {}
    },
    async updatePlaceDetails({ commit }, { form }) {
        try {
            const { data } = await form.post('/api/update_myPlace')
            if (data.error == 0)
                commit(types.UPDATE_PLACE_SUCCESS, { place: form })
        } catch (e) {}
    },
    async addPlaceService({ commit }, { form }) {
        try {
            const { data } = await form.post('/api/Service/add_services')
            if (data.error == 0)
                commit(types.ADD_PLACE_SERVICE_SUCCESS, { service: data.data })
        } catch (e) {}
    },
    async addPlaceProduct({ commit }, { form }) {
        try {
            const { data } = await form.post('/api/Product/add_product')
            if (data.error == 0)
                commit(types.ADD_PLACE_PRODUCT_SUCCESS, { product: data.data })
        } catch (e) {}
    },
    async addPlaceOffer({ commit }, { form }) {
        try {
            const { data } = await form.post('/api/Offer/add_offers')
            if (data.error == 0)
                commit(types.ADD_PLACE_OFFER_SUCCESS, { offer: data.data })
        } catch (e) {}
    },

    // category place
    async fetchCategoryPlaces({ commit }, { id }) {
        try {
            const { data } = await axios.get('/api/show_places_BySubcatId?subcat_id=' + id)
            commit(types.FETCH_CATEGORY_PLACES_SUCCESS, { categoryPlaces: data.data })
        } catch (e) {}
    },
    async toggleFavCategoryPlace({ commit }, { id }) {
        try {
            await axios.get('/api/add_favorite?place_id=' + id)
            commit(types.TOGGLE_FAV_CATEGORY_PLACE_SUCCESS, { id: id })
        } catch (e) {}
    },

    // favorites
    async fetchFavorites({ commit }) {
        try {
            const { data } = await axios.get('/api/show_all_favorites')
            commit(types.FETCH_FAVORITE_PLACES_SUCCESS, { favorites: data.data })
        } catch (e) {}
    },
    async toggleFavFavoritePlace({ commit }, { id }) {
        try {
            await axios.get('/api/add_favorite?place_id=' + id)
            commit(types.TOGGLE_FAV_FAVORITE_PLACE_SUCCESS, { id: id })
        } catch (e) {}
    },
}