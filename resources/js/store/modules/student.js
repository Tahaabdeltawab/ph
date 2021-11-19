import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
    universities: [],
    faculties: [],
    years: [],
    topics: [],
    chapters: [],
    questions: [],
}

// getters
export const getters = {
    universities: state => state.universities,
    faculties: state => state.faculties,
    years: state => state.years,
    topics: state => state.topics,
    chapters: state => state.chapters,
    questions: state => state.questions,
}

// mutations
export const mutations = {
    [types.FETCH_UNIVERSITIES_SUCCESS](state, { universities }) {
        state.universities = universities;
    },
    [types.ADD_UNIVERSITY_SUCCESS](state, { university }) {
        state.universities.push(university)
    },


    [types.FETCH_FACULTIES_SUCCESS](state, { faculties }) {
        state.faculties = faculties;
    },
    [types.FETCH_YEARS_SUCCESS](state, { years }) {
        state.years = years;
    },
    [types.FETCH_TOPICS_SUCCESS](state, { topics }) {
        state.topics = topics;
    },
    [types.FETCH_CHAPTERS_SUCCESS](state, { chapters }) {
        state.chapters = chapters;
    },
    [types.FETCH_QUESTIONS_SUCCESS](state, { questions }) {
        state.questions = questions;
    },
}

// actions
export const actions = {
    async fetchUniversities({ commit }) {
        try {
            const { data } = await axios.get('/api/admin/universities')
            commit(types.FETCH_UNIVERSITIES_SUCCESS, { universities: data.data })
        } catch (e) {}
    },
    async addUniversity({ commit }, { form }) {
        try {
            const { data } = await form.post('/api/admin/universities')
            if (data.success)
                commit(types.ADD_UNIVERSITY_SUCCESS, { university: data.data })
        } catch (e) {}
    },


    async fetchFaculties({ commit }, { university }) {
        try {
            let params = { university };
            const { data } = await axios.get('/api/admin/faculties', { params: params })
            commit(types.FETCH_FACULTIES_SUCCESS, { faculties: data.data })
        } catch (e) {}
    },
    async fetchYears({ commit }, { faculty }) {
        try {
            let params = { faculty };
            const { data } = await axios.get('/api/admin/years', { params: params })
            commit(types.FETCH_YEARS_SUCCESS, { years: data.data })
        } catch (e) {}
    },
    async fetchTopics({ commit }, { year }) {
        try {
            let params = { year };
            const { data } = await axios.get('/api/admin/topics', { params: params })
            commit(types.FETCH_TOPICS_SUCCESS, { topics: data.data })
        } catch (e) {}
    },
    async fetchChapters({ commit }, { topic }) {
        try {
            let params = { topic };
            const { data } = await axios.get('/api/admin/chapters', { params: params })
            commit(types.FETCH_CHAPTERS_SUCCESS, { chapters: data.data })
        } catch (e) {}
    },
    async fetchQuestions({ commit }, { chapter }) {
        try {
            let params = { chapter };
            const { data } = await axios.get('/api/admin/questions', { params: params })
            commit(types.FETCH_QUESTIONS_SUCCESS, { questions: data.data })
        } catch (e) {}
    },
}