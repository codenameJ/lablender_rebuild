import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/mainhome/Home';
import Adminlabs from './pages/admin/Adminlabs';
import User from './pages/admin/User';
import Studentlabs from './pages/student/Studentlabs';
import About from './pages/mainhome/About';
import Homecard from './pages/lab/Homecard';
import Talabs from './pages/ta/Talabs';
import Professorlabs from './pages/professor/Professorlabs';
//admin lab page
import Equipment from './pages/lab/Equipment';
import Announcement from './pages/lab/Announcement';
import History from './pages/lab/History';
import Request from './pages/lab/Request';

Vue.component('Home', Home);
Vue.component('Adminlabs', Adminlabs);
Vue.component('Studentlabs', Studentlabs);
Vue.component('About', About);
Vue.component('User', User);
Vue.component('Homecard', Homecard);
Vue.component('Talabs', Talabs);
Vue.component('Professorlabs', Professorlabs);
//admin lab page
Vue.component('Equipment', Equipment);
Vue.component('Announcement', Announcement);
Vue.component('History', History);
Vue.component('Request', Request);

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
            component: Talabs,
        },
        //professor
        {
            path: '/professor/labs',
            component: Professorlabs,
        },
        {
            path: '/professor/users',
            component: User,
        },
        //admin home page
        {
            path: '/admin/labs',
            component: Adminlabs,
        },
        {
            path: '/admin/user',
            component: User,
        },
        //admin lab page
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
        {
            path: '/admin/lab/:course_id/announcement',
            props: true,
            name: 'announcement',
            component: Announcement,
        },
        {
            path: '/admin/lab/:course_id/history',
            props: true,
            name: 'history',
            component: History,
        },
        {
            path: '/admin/lab/:course_id/request',
            props: true,
            name: 'request',
            component: Request,
        },
    ],
    mode: 'history',
    base: process.env.BASE_URL,
})