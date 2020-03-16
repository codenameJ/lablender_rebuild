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
import Professorenrollment from './pages/professor/Professorenrollment';
import Adminenrollment from './pages/admin/Adminenrollment';
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
Vue.component('Professorenrollment', Professorenrollment);
Vue.component('Adminenrollment', Adminenrollment);
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
         //student lab page
         {
            path: '/student/lab/:course_id/home',
            props: true,
            component: Homecard,
        },
        {
            path: '/student/lab/:course_id/equipment',
            props: true,
            name: 'student_equipment',
            component: Equipment,
        },
        {
            path: '/student/lab/:course_id/announcement',
            props: true,
            name: 'student_announcement',
            component: Announcement,
        },
        {
            path: '/student/lab/:course_id/history',
            props: true,
            name: 'student_history',
            component: History,
        },
        {
            path: '/student/lab/:course_id/request',
            props: true,
            name: 'student_request',
            component: Request,
        },
        //ta
        {
            path: '/ta/labs',
            component: Talabs,
        },
        //ta lab page
        {
            path: '/ta/lab/:course_id/home',
            props: true,
            component: Homecard,
        },
        {
            path: '/ta/lab/:course_id/equipment',
            props: true,
            name: 'ta_equipment',
            component: Equipment,
        },
        {
            path: '/ta/lab/:course_id/announcement',
            props: true,
            name: 'ta_announcement',
            component: Announcement,
        },
        {
            path: '/ta/lab/:course_id/history',
            props: true,
            name: 'ta_history',
            component: History,
        },
        {
            path: '/ta/lab/:course_id/request',
            props: true,
            name: 'ta_request',
            component: Request,
        },
        //professor
        {
            path: '/professor/labs',
            component: Professorlabs,
        },
        {
            path: '/professor/enrolls',
            component: Professorenrollment,
        },
        {
            path: '/professor/users',
            component: User,
        },
        //professor lab page
        {
            path: '/professor/lab/:course_id/home',
            props: true,
            component: Homecard,
        },
        {
            path: '/professor/lab/:course_id/equipment',
            props: true,
            name: 'professor_equipment',
            component: Equipment,
        },
        {
            path: '/professor/lab/:course_id/announcement',
            props: true,
            name: 'professor_announcement',
            component: Announcement,
        },
        {
            path: '/professor/lab/:course_id/history',
            props: true,
            name: 'professor_history',
            component: History,
        },
        {
            path: '/professor/lab/:course_id/request',
            props: true,
            name: 'professor_request',
            component: Request,
        },
        //admin home page
        {
            path: '/admin/labs',
            component: Adminlabs,
        },
        {
            path: '/admin/enrolls',
            component: Adminenrollment,
        },
        {
            path: '/admin/user',
            component: User,
        },
        //admin lab page
        {
            path: '/admin/lab/:course_id/home',
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