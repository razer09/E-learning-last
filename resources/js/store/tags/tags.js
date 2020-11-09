
const state = {
    tags: []
};

const mutations = {
    setTags: (state, tags)=>{
        state.tags = tags;
    },
};

const actions = {
    setTags: ({commit}, tags)=>{
        commit('setTags', tags);
    }
};

const getters = {
    tags: state => { return state.tags; }
};


export default {
    state,
    getters,
    mutations,
    actions
};
