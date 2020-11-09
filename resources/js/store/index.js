import Vuex from "vuex";
import createPersistedState from 'vuex-persistedstate';

import tags from "./tags/tags.js";
import user from "./user/user.js"

export default new Vuex.Store({
     modules: {
        tags,
        user
    },
    plugins: [createPersistedState()],
    state: {

    },
    mutations: {

    },
    actions: {

    },

});
