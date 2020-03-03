export default{
    state: {
        welcome: 'welcome',
        labs: [],
        selectedLab: {}
    },
    mutations: {
        SetLabs(state, labs){
            state.labs=labs;
        }
    },
    getters: {
        getcurrentlab: (state) => (course_id) => {
            return state.labs.find(lab => lab.course_id === course_id)
          }
    },
    actions: {
        loadLabs({commit}){
            axios.get("/api/lab").then(data => {console.log(data.data)
            let labs = data.data
            commit('SetLabs', labs)
        })
        },
    },
};