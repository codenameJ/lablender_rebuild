import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/mainhome/Home';
import Adminlabs from './pages/admin/Adminlabs';
import User from './pages/admin/User';
import Studentlabs from './pages/student/Studentlabs';
import About from './pages/mainhome/About';
import StudentHomecard from './pages/lab/StudentHomecard';
import Talabs from './pages/ta/Talabs';
import Homecard from './pages/lab/Homecard';
import Professorlabs from './pages/professor/Professorlabs';
import Professorenrollment from './pages/professor/Professorenrollment';
import Professorassign from './pages/professor/Professorassign';
import Adminenrollment from './pages/admin/Adminenrollment';
import Adminassign from './pages/admin/Adminassign';
import Taenrollment from './pages/ta/Taenrollment'
//admin lab page
import Equipment from './pages/lab/Equipment';
import Announcement from './pages/lab/Announcement';
import History from './pages/lab/History';
import Request from './pages/lab/Request';
import Maintenance from './pages/lab/Maintenance';

//student lab page
import StudentEquipment from './pages/lab/StudentEquipment'
import StudentRequest from './pages/lab/StudentRequest';
import StudentHistory from './pages/lab/StudentHistory';

Vue.component('Home', Home);
Vue.component('Adminlabs', Adminlabs);
Vue.component('Studentlabs', Studentlabs);
Vue.component('About', About);
Vue.component('User', User);
Vue.component('StudentHomecard', Homecard);
Vue.component('Talabs', Talabs);
Vue.component('Homecard', Homecard);
Vue.component('Professorlabs', Professorlabs);
Vue.component('Professorenrollment', Professorenrollment);
Vue.component('Professorassign', Professorassign);
Vue.component('Adminenrollment', Adminenrollment);
Vue.component('Adminassign', Adminassign);
Vue.component('Taenrollment', Taenrollment);
//admin lab page
Vue.component('Equipment', Equipment);
Vue.component('Announcement', Announcement);
Vue.component('History', History);
Vue.component('Request', Request);
Vue.component('Maintenance', Maintenance);

//student lab page
Vue.component('StudentEquipment', StudentEquipment);
Vue.component('StudentRequest', StudentRequest);
Vue.component('StudentHistory', StudentHistory);

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
            component: StudentHomecard,
        },
        {
            path: '/student/lab/:course_id/equipment',
            props: true,
            name: 'student_equipment',
            component: StudentEquipment,
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
            component: StudentHistory,
        },
        {
            path: '/student/lab/:course_id/maintenance',
            props: true,
            name: 'student_maintenance',
            component: Maintenance,
        },
        {
            path: '/student/lab/:course_id/request',
            props: true,
            name: 'student_request',
            component: StudentRequest,
        },

        //ta
        {
            path: '/ta/labs',
            component: Talabs,
        },
        {
            path: '/ta/enrolls',
            component: Taenrollment,
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
        {
            path: '/ta/lab/:course_id/maintenance',
            props: true,
            name: 'ta_maintenance',
            component: Maintenance,
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
            path: '/professor/assigns',
            component: Professorassign,
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
        {
            path: '/professor/lab/:course_id/maintenance',
            props: true,
            name: 'professor_maintenance',
            component: Maintenance,
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
            path: '/admin/assign',
            component: Adminassign,
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
        {
            path: '/admin/lab/:course_id/maintenance',
            props: true,
            name: 'maintenance',
            component: Maintenance,
        },
    ],
    mode: 'history',
    base: process.env.BASE_URL,
})