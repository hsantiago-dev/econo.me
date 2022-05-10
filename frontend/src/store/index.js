import Vuex from 'vuex'
import Vue from 'vue'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex)

export const store = new Vuex.Store( {
    state: {
        userId: 0,
    },
    plugins: [createPersistedState()],
    mutations: {
        setUserId (store, userId) {
            store.userId = userId
        },
    },
    actions: {
        setUserId: ({ commit }, userId) => {
            commit('setUserId', userId)
        },
    },
    getters: {
        getUserId: state => state.userId,
    },
} )