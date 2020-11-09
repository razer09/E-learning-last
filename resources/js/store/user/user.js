
const state = {
    login: false,
    user: {},
    roles: []
};

const mutations = {
    setUser: (state, user)=>{
        state.user    = user;
        state.login   = true;
    },
    logout: (state)=>{
        state.user = null;
        state.login = false;
    },
    updateUser: (state, user)=>{
        state.user = user;
    },
    setRoles: (state, roles)=>{
        state.roles = roles;
    }
};

const actions = {
    setUser: ({commit}, user)=>{
        commit('setUser', user);
    },
    logout: ({commit})=>{
        commit('logout');
    },
    updateUser: ({commit}, user)=>{
        commit('updateUser', user);
    },
    setRoles: ({commit}, roles)=>{
        commit('setRoles', roles);
    }
};

const getters = {
    user: state => { return state.user; },
    login: state => { return state.login; },
    roles: state => { return state.roles; }
};


export default {
    state,
    getters,
    mutations,
    actions
};
