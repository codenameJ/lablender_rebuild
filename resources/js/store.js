import createPersistedState from 'vuex-persistedstate'

export default {
    state: {
        users: [],
        tas: [],
        students: [],
        labs: [],
        equipments: [],
        request_lists: [],
        missing_lists: [],
        broken_lists: [],
        request_details: [],
        announcements: [],
        selectedLab: {},
        selectedUser: {},
        cart:[],
        notifications: [],
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
        SetMissing_lists(state, missing_lists){
            state.missing_lists=missing_lists;
        },
        SetBroken_lists(state, broken_lists){
            state.broken_lists=broken_lists;
        },
        SetRequest_details(state, request_details){
            state.request_details=request_details;
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
                if(total > item.equip_qty){
                    total = item.equip_qty;
                }
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
        //notification
        SetNotifications(state, notifications){
            state.notifications=notifications;
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
            request_lists.forEach(request_list => {
                request_list.tempStatus =  data.data.status
            });
            commit('SetRequest_lists', request_lists)
        })
        },
        loadMissing_lists({commit}){
            axios.get("/api/missinglist").then(data => {
                // console.log(data.data)
            let missing_lists = data.data
            missing_lists.forEach(missing_list => {
                missing_list.tempStatus =  data.data.status
            });
            commit('SetMissing_lists', missing_lists)
        })
        },
        loadBroken_lists({commit}){
            axios.get("/api/brokenlist").then(data => {
                // console.log(data.data)
            let broken_lists = data.data
            broken_lists.forEach(broken_list => {
                broken_list.tempStatus =  data.data.status
            });
            commit('SetBroken_lists', broken_lists)
        })
        },
        loadRequest_details({commit}){
            axios.get("/api/requestdetail").then(data => {
                // console.log(data.data)
            let request_details = data.data
            commit('SetRequest_details', request_details)
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
        //notification
        loadNotifications({commit}, notifications){
            commit('SetNotifications', notifications)
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