import createPersistedState from 'vuex-persistedstate'

export default{
    state: {
        users: [],
        labs: [],
        equipments: [],
        request_lists: [],
        announcements: [],
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
        SetAnnouncements(state, announcements){
            state.announcements=announcements;
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
        loadAnnouncements({commit}){
            axios.get("/api/announcement").then(data => {
                console.log(data.data)
            let announcements = data.data
            commit('SetAnnouncements', announcements)
        })
        },
        loadRequest_lists({commit}){
            axios.get("/api/requestlist").then(data => {
                console.log(data.data)
            let request_lists = data.data
            commit('SetRequest_lists', request_lists)
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