import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/mainhome/Home';
import Equipment from './pages/lab/Equipment';
import Adminlabs from './pages/admin/Adminlabs';
import User from './pages/admin/User';
import Studentlabs from './pages/student/Studentlabs';
import About from './pages/mainhome/About';
import Homecard from './pages/lab/Homecard';


Vue.component('Home', Home);
Vue.component('Adminlabs', Adminlabs);
Vue.component('Studentlabs', Studentlabs);
Vue.component('About', About);
Vue.component('User', User);
Vue.component('Equipment', Equipment);
Vue.component('Homecard', Homecard);

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        //mainhome
        {
            path: '/home',
            component: Home,
        },
        {
            path: '/about',
            component: About,
        },
        //student
        {
            path: '/labs',
            component: Studentlabs,
        },
        //ta
        {
            path: '/ta/labs',
            component: Studentlabs,
        },
        //professor
        {
            path: 'professor/labs',
            component: Studentlabs,
        },
        //admin
        {
            path: '/admin/labs',
            component: Adminlabs,
        },
        {
            path: '/admin/user',
            component: User,
        },
        {
            path: '/admin/lab/:course_id',
            props: true,
            component: Homecard,
        },
        {
            path: '/admin/lab/:course_id/equipment',
            props: true,
            name: 'equipment',
            component: Equipment,
        },
        
    ],
    mode: 'history',
    base: process.env.BASE_URL,
})