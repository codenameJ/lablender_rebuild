import createPersistedState from 'vuex-persistedstate'

export default {
    state: {
        users: [],
        tas: [],
        students: [],
        labs: [],
        equipments: [],
        request_lists: [],
        announcements: [],
        selectedLab: {},
        selectedUser: {},

        cart:[],
    },
    plugins: [createPersistedState()],
    mutations: {
        //set array data zone
        SetLabs(state, labs){
            state.labs=labs;
        },
        SetUsers(state, users) {
            state.users = users;
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
        SetTas(state, tas){
            state.tas=tas;
        },
        SetStudents(state, students){
            state.students=students;
        },
        //cart
        addToCart(state, item){
            let found = state.cart.find(product => product.equip_id == item.equip_id);
            
            if(found){
                var oldamount = parseInt(found.amount);
                var inamount = parseInt(item.amount);
                var total = oldamount + inamount;
                found.amount = total;
            }else{
            state.cart.push(item);
            }
            // state.cart.push(item);
        },
        removeFromCart(state, index){
            // let index = state.cart.indexOf(item);
            state.cart.splice(index,1);
        },
        clearCart(state){
            state.cart = [];
        },
        SetNewCart(state, cartlength){
            state.cart.splice(0, cartlength);
        },
        //set current zone
        SetCurrentLab(state, selectedLab){
            state.selectedLab=selectedLab;
        },
        SetCurrentUser(state, selectedUser) {
            state.selectedUser = selectedUser;
        },
    },
    getters: {
    },
    actions: {
        //load data array zone
        loadLabs({commit}){
            axios.get("/api/lab").then(data => {
                // console.log(data.data)
            let labs = data.data
            commit('SetLabs', labs)
        })
        },
        loadUsers({ commit }) {
            axios.get("/api/user").then(data => {
                // console.log(data.data)
            let users = data.data
            commit('SetUsers', users)
        })
        },
        loadEquipments({commit}){
            axios.get("/api/equipment").then(data => {
                // console.log(data.data)
            let equipments = data.data
            commit('SetEquipments', equipments)
        })
        },
        loadAnnouncements({commit}){
            axios.get("/api/announcement").then(data => {
                // console.log(data.data)
            let announcements = data.data
            commit('SetAnnouncements', announcements)
        })
        },
        loadRequest_lists({commit}){
            axios.get("/api/requestlist").then(data => {
                // console.log(data.data)
            let request_lists = data.data
            commit('SetRequest_lists', request_lists)
        })
        },
        loadTas({commit}){
            axios.get("/api/ta").then(data => {
                // console.log(data.data)
            let tas = data.data
            commit('SetTas', tas)
        })
        },
        loadStudents({commit}){
            axios.get("/api/student").then(data => {
                // console.log(data.data)
            let students = data.data
            commit('SetStudents', students)
        })
        },
        //cart
        clearCartItems({ commit }) {
            commit('clearCart');
        },
        //load current zone
        currentLab({commit}, curlab){
            commit('SetCurrentLab', curlab)
        },
        currentUser({ commit }, curuser) {
            commit('SetCurrentUser', curuser)
        },
    },


};