// import createPersistedState from 'vuex-persistedstate'

export default{
    state: {
        users: [],
        labs: [],
        selectedLab: {},
        selectedUser: {},
    },
    // plugins: [createPersistedState()],
    mutations: {
        SetLabs(state, labs){
            state.labs=labs;
        },
        SetUsers(state, users){
            state.users=users;
        },
        SetCurrentLab(state, selectedLab){
            state.selectedLab=selectedLab;
        },
        SetCurrentUser(state, selectedUser){
            state.selectedUser=selectedUser;
        },
    },
    getters: {
        getcurrentlab: (state) => (course_id) => {
            return state.labs.find(lab => lab.course_id === course_id)
          },

          professerlab: state => {
            return state.labs.filter(lab => lab.professor_name)
          },
    },
    actions: {
        loadLabs({commit}){
            axios.get("/api/lab").then(data => {console.log(data.data)
            let labs = data.data
            commit('SetLabs', labs)
        })
        },
        loadUsers({commit}){
            axios.get("/api/user").then(data => {console.log(data.data)
            let users = data.data
            commit('SetUsers', users)
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