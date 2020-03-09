import createPersistedState from 'vuex-persistedstate'

export default{
    state: {
        users: [],
        labs: [],
        equipments: [],
        request_lists: [],
        selectedLab: {},
        selectedUser: {},
    },
    plugins: [createPersistedState()],
    mutations: {
        SetLabs(state, labs){
            state.labs=labs;
        },
        SetUsers(state, users){
            state.users=users;
        },
        SetEquipments(state, equipments){
            state.equipments=equipments;
        },
        SetRequest_lists(state, request_lists){
            state.request_lists=request_lists;
        },
        SetCurrentLab(state, selectedLab){
            state.selectedLab=selectedLab;
        },
        SetCurrentUser(state, selectedUser){
            state.selectedUser=selectedUser;
        },
    },
    getters: {
    },
    actions: {
        loadLabs({commit}){
            axios.get("/api/lab").then(data => {
                // console.log(data.data)
            let labs = data.data
            commit('SetLabs', labs)
        })
        },
        loadUsers({commit}){
            axios.get("/api/user").then(data => {
                console.log(data.data)
            let users = data.data
            commit('SetUsers', users)
        })
        },
        loadEquipments({commit}){
            axios.get("/api/equipment").then(data => {
                console.log(data.data)
            let equipments = data.data
            commit('SetEquipments', equipments)
        })
        },
        loadRequest_lists({commit}){
            axios.get("/api/request_list").then(data => {
                console.log(data.data)
            let request_lists = data.data
            commit('SetEquipments', request_lists)
        })
        },
        currentLab({commit}, curlab){
            commit('SetCurrentLab', curlab)
        },
        currentUser({commit}, curuser){
            commit('SetCurrentUser', curuser)
        },
    },


};