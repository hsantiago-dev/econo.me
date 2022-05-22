import Vuex from 'vuex'
import Vue from 'vue'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

export const store = new Vuex.Store( {
    state: {
        userId: 0,
        username: ''
    },
    plugins: [createPersistedState()],
    mutations: {
        setUserId (store, userId) {
            store.userId = userId
        },
        setUsername (store, username) {
            store.username = username
        },
    },
    actions: {
        setUserId: ({ commit }, userId) => {
            commit('setUserId', userId)
        },
        setUsername: ({ commit }, username) => {
            commit('setUsername', username)
        },
    },
    getters: {
        getUserId: state => state.userId,
        getUsername: state => state.username,
    },
} )