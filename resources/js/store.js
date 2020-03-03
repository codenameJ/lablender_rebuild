// import createPersistedState from 'vuex-persistedstate'

export default{
    state: {
        labs: [],
        selectedLab: {},
    },
    // plugins: [createPersistedState()],
    mutations: {
        SetLabs(state, labs){
            state.labs=labs;
        },
        SetCurrentLab(state, selectedLab){
            state.selectedLab=selectedLab;
        },
    },
    getters: {
        getcurrentlab: (state) => (course_id) => {
            return state.labs.find(lab => lab.course_id === course_id)
          },
    },
    actions: {
        loadLabs({commit}){
            axios.get("/api/lab").then(data => {console.log(data.data)
            let labs = data.data
            commit('SetLabs', labs)
        })
        },
        currentLab({commit}, curlab){
            commit('SetCurrentLab', curlab)
        },
    },


};