<template>
<div id="app" v-if="curlab">
    <nav>
        <v-toolbar flat>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Lab Lender</v-toolbar-title>
            <v-spacer></v-spacer>
            <lendingcart />
            <v-menu offset-y origin="center center" class="elelvation-1" :nudge-bottom="14" transition="scale-transition">
                <template v-slot:activator="{ on }">
                    <v-btn @click="markAsRead" icon v-on="on">
                        <v-badge overlap>
                            <span slot="badge">{{
                                    unreadNotifications.length
                                }}</span>
                            <v-icon>notifications</v-icon>
                        </v-badge>
                    </v-btn>
                </template>

                <v-list three-line>
                    <v-list-item-title v-if="allNotifications.length != 0" class="ml-4 mt-2 headline">
                        Notifications
                    </v-list-item-title>
                    <p v-if="allNotifications.length == 0">
                        <center>
                            No notifications.
                        </center>
                    </p>
                    <!--  <v-list-item
                            v-for="(notification, i) in allNotifications"
                            :key="i"
                        >
                        <v-row>
                            <v-list-item-content>
                                <v-icon small :color="getColor(notification.data.NewLendingRequest.status)">build</v-icon>
                                <v-list-item-title
                                    >Request No.
                                    {{ notification.data.NewLendingRequest.id }}
                                    is
                                    {{
                                        notification.data.NewLendingRequest
                                            .status
                                    }}</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-icon>
                                <v-icon
                                    small
                                    v-if="!notification.read_at"
                                    color="
                                    blue
                                    "
                                    >lens</v-icon
                                >
                            </v-list-item-icon>
                            </v-row>
                            <v-divider></v-divider>
                        </v-list-item> -->
                    <v-list-item v-for="(notification, i) in allNotifications" :key="i">
                        <v-list-item-avatar>
                            <v-icon :color="getColor(notification.data.NewLendingRequest.status)">{{getIcon(notification.data.NewLendingRequest.status)}}</v-icon>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title>Request No.
                                {{ notification.data.NewLendingRequest.id }}
                                is
                                {{
                                        notification.data.NewLendingRequest.status
                                    }}</v-list-item-title>
                            <v-list-item-subtitle>Description</v-list-item-subtitle>
                        </v-list-item-content>
                        <v-list-item-icon>
                                <v-icon
                                    small
                                    v-if="!notification.read_at"
                                    color="
                                    blue
                                    "
                                    >lens</v-icon
                                >
                            </v-list-item-icon>
                    </v-list-item>

                </v-list>
            </v-menu>

            <v-menu bottom left>
                <template v-slot:activator="{ on }">
                    <v-btn icon v-on="on">
                        <v-icon>mdi-account</v-icon>
                    </v-btn>
                </template>

                <v-card>
                    <v-list>
                        <v-list-item>
                            <v-list-item-avatar>
                                <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title>{{
                                        username
                                    }}</v-list-item-title>
                                <v-list-item-subtitle>{{
                                        type
                                    }}</v-list-item-subtitle>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn style="text-decoration : none; color : #000000;" href="/logout" text @click="menu = false">Log out</v-btn>
                    </v-card-actions>
                </v-card>
            </v-menu>
        </v-toolbar>

        <v-navigation-drawer app v-model="drawer" class="nav-gradient" overlay-opacity="70" absolute dark>
            <v-list-item>
                <v-img class="mt-3" src="/img/icon.png" max-width="50" max-height="50">
                </v-img>
                <div class="mx-4 pt-3 font-weight-bold" style="font-size:1.5em">
                    {{ curlab.course_name }}
                    {{ curlab.course_id }}
                </div>
            </v-list-item>
            <v-divider></v-divider>

            <v-list nav dense v-if="type == 'admin'">
                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/home'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/announcement'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">announcement</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประกาศ
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/equipment'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">store</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">อุปกรณ์</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/request'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">assignment</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            คำขอยืม
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/history'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">history</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประวัติ</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/maintenance'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">build</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">บำรุงรักษา</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item href="/admin/labs" class="menuhref" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">keyboard_backspace</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            กลับสู่หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list nav dense v-if="type == 'professor'">
                <v-list-item class="menuhref" :to="'/professor/lab/' + curlab.course_id + '/home'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="
                            '/professor/lab/' +
                                curlab.course_id +
                                '/announcement'
                        " link>
                    <v-list-item-action>
                        <v-icon class="ml-2">announcement</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประกาศ
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="
                            '/professor/lab/' + curlab.course_id + '/equipment'
                        " link>
                    <v-list-item-action>
                        <v-icon class="ml-2">store</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            อุปกรณ์
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/professor/lab/' + curlab.course_id + '/request'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">assignment</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            คำขอยืม
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/professor/lab/' + curlab.course_id + '/history'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">history</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประวัติ
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/maintenance'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">build</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">บำรุงรักษา</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item href="/professor/labs" class="menuhref" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">keyboard_backspace</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            กลับสู่หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list nav dense v-if="type == 'ta'">
                <v-list-item class="menuhref" :to="'/ta/lab/' + curlab.course_id + '/home'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/ta/lab/' + curlab.course_id + '/announcement'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">announcement</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประกาศ
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/ta/lab/' + curlab.course_id + '/equipment'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">store</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            อุปกรณ์
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/ta/lab/' + curlab.course_id + '/request'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">assignment</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            คำขอยืม
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/ta/lab/' + curlab.course_id + '/history'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">history</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประวัติ
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/admin/lab/' + curlab.course_id + '/maintenance'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">build</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">บำรุงรักษา</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item href="/ta/labs" class="menuhref" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">keyboard_backspace</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            กลับสู่หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>

            <v-list nav dense v-if="type == 'student'">
                <v-list-item class="menuhref" :to="'/student/lab/' + curlab.course_id + '/home'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="
                            '/student/lab/' + curlab.course_id + '/announcement'
                        " link>
                    <v-list-item-action>
                        <v-icon class="ml-2">announcement</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประกาศ
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/student/lab/' + curlab.course_id + '/equipment'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">store</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            อุปกรณ์</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/student/lab/' + curlab.course_id + '/request'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">assignment</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            คำขอยืม
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item class="menuhref" :to="'/student/lab/' + curlab.course_id + '/history'" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">history</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            ประวัติ
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <!-- <v-list-item
                        class="menuhref"
                        :to="'/admin/lab/' + curlab.course_id + '/maintenance'"
                        link
                    >
                        <v-list-item-action>
                            <v-icon class="ml-2">build</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>บำรุงรักษา</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item> -->

                <v-list-item class="menuhref" href="/labs" link>
                    <v-list-item-action>
                        <v-icon class="ml-2">keyboard_backspace</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title style="font-size:16px">
                            กลับสู่หน้าหลัก
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </nav>
</div>
</template>

<script>
export default {
    props: ["username", "type", "notifications"],

    created() {},
    mounted() {
        // this.$store.commit("SetNewCart", this.viewCart.length);
        this.$store.dispatch("clearCartItems");
        this.$store.dispatch("loadLabs");
        this.$store.dispatch("loadUsers");
        // this.$store.dispatch("currentLab");
        console.log(this.username);
    },
    name: "Header",
    components: {},
    data: () => ({
        post: null,
        error: null,
        appName: process.env.APP_NAME,
        fixed: false,
        dialog: false,
        drawer: true,
        unreadNotifications: [],
        allNotifications: []
    }),

    created() {
        this.allNotifications = this.notifications;

        this.unreadNotifications = this.allNotifications.filter(
            notification => {
                return notification.read_at == null;
            }
        );
    },

    computed: {
        viewCart() {
            return this.$store.state.cart;
        },
        users() {
            return this.$store.state.users;
        },
        curuser() {
            let seluser =
                this.users.find(user => user.name == this.username) || {};
            this.$store.dispatch("currentUser", seluser);
            return seluser;
        },
        isMobile() {
            return window.innerWidth < 600;
        },
        labs() {
            return this.$store.state.labs;
        },
        curlab() {
            let sellab =
                this.labs.find(
                    lab => lab.course_id == this.$route.params.course_id
                ) || {};
            this.$store.dispatch("currentLab", sellab);
            return sellab;
        }
    },

    watch: {
        allNotifications(val) {
            this.unreadNotifications = this.allNotifications.filter(
                notification => {
                    return notification.read_at == null;
                }
            );
        },
        dialog(val) {
            val || this.close();
        }
    },

    methods: {
        getIcon(status) {
            if (status == "ready") return "assignment_turned_in";
            else if (status == "broken") return "report";
            else if (status == "missing") return "report";
            else if (status == "return") return "archive";
            else if (status == "receive") return "unarchive";
        },
        getColor(status) {
            if (status == "wait") return "blue-grey";
            else if (status == "ready") return "green";
            else if (status == "broken") return "red";
            else if (status == "missing") return "orange accent-2";
            else if (status == "return") return "#1a73e8";
            else return "#CE93D8";
        },
        markAsRead() {
            axios.get("/mark-all-read/" + this.curuser.id).then(Response => {
                this.unreadNotifications = [];
            });
        },
        sidebarToggle() {
            this.drawer = !this.drawer;
        }
    }
};
</script>

<style scoped>
.userhref {
    text-decoration: none;
    color: #000000;
}

.menuhref {
    text-decoration: none;
    color: #ffffff;
}

.nav-gradient {
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    position: fixed;
}
</style>
