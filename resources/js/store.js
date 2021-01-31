import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({

    state: {
        darkMode: false,
        user: false,
        postUrlPrefix: 'http://127.0.0.1:8000/uploads',
        sellerAvatarPrefix: 'http://127.0.0.1:8000/uploads',
        user_token: null,
    },
    getters: {
        getUser(state) {
            return state.user
        },
        getUserToken: state => {
            return state.user_token
        }
    },
    mutations: {
        updateUser(state, data) {
            state.user = data
        },
        commitUserToken(state, data) {
            state.user_token = data
        },
    },
    actions: {

    }
})