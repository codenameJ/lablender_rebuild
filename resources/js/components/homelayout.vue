<template>
    <div id="app" v-if="curuser">
        <v-toolbar
            dark
            tabs
            flat
            style="background-image: linear-gradient(to right, #2ad4d9, #2ad4a9;"
            height="100"
        >
            <v-toolbar-title>
                <v-list-item>
                    <v-img
                        class="m-2"
                        src="/img/icon.png"
                        max-width="50"
                        max-height="50"
                    >
                    </v-img>
                    <h2 class="m-3 text-uppercase">
                        <b>Lab Lender</b>
                    </h2>
                </v-list-item>

                <!-- <v-list-title
                    class="m-4 font-weight-bold"
                    style="font-size: 20px"
                >
                    Lab List
                </v-list-title> -->
            </v-toolbar-title>

            <v-spacer></v-spacer>
            <v-toolbar-title>
                <v-menu
                    offset-y
                    origin="center center"
                    class="elelvation-1"
                    :nudge-bottom="14"
                    transition="scale-transition"
                >
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

                    <v-list>
                        <v-list-item
                            v-for="(notification, i) in allNotifications.slice(0, 10)"
                            :key="i"
                            :class="{'green': notification.read_at==null}"
                        >
                            <v-list-item-content>
                                <v-list-item-title
                                    >Request No.
                                    {{ notification.data.NewLendingRequest.id }}
                                    is
                                    {{
                                        notification.data.NewLendingRequest
                                            .status
                                    }}</v-list-item-title
                                >
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
                <v-menu offset-y :nudge-bottom="14">
                    <template v-slot:activator="{ on }">
                        <v-btn icon color="white" v-on="on">
                            <v-icon>mdi-account</v-icon>
                        </v-btn>
                    </template>

                    <v-card>
                        <v-list>
                            <v-list-item>
                                <v-list-item-avatar>
                                    <img
                                        src="https://cdn.vuetifyjs.com/images/john.jpg"
                                        alt="John"
                                    />
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

                        <v-card-actions>
                            <v-spacer></v-spacer>

                            <v-btn
                                style="text-decoration : none; color : #000000;"
                                href="/logout"
                                text
                                @click="menu = false"
                                >Log out</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-menu>
            </v-toolbar-title>
            <!-- background-color="#2ad4a9" -->
            <template v-slot:extension>
                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'admin'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/admin/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/admin/enrolls"
                        >Manage Enrollment</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/admin/assign"
                        >Manage Assign</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/admin/user"
                        >Manage User</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </v-tabs>

                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'professor'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/professor/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab
                        style="text-decoration : none;"
                        to="/professor/enrolls"
                        >Manage Enrollment</v-tab
                    >
                    <v-tab
                        style="text-decoration : none;"
                        to="/professor/assigns"
                        >Manage Assign</v-tab
                    >
                    <!-- <v-tab style="text-decoration : none;" to="/professor/users"
                        >Manage User</v-tab
                    > -->
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </v-tabs>

                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'ta'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/ta/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/ta/enrolls"
                        >Manage Enrollment</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </v-tabs>

                <v-tabs
                    background-color="transparent"
                    v-model="tabs"
                    v-if="type == 'student'"
                    align-with-title
                >
                    <v-tab style="text-decoration : none;" to="/home"
                        >Dashboard</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/labs"
                        >Our Labs</v-tab
                    >
                    <v-tab style="text-decoration : none;" to="/about"
                        >About</v-tab
                    >
                    <v-tabs-slider color="white"></v-tabs-slider>
                </v-tabs>

                <v-spacer></v-spacer>
            </template>
        </v-toolbar>
    </div>
</template>

<script>
export default {
    props: ["username", "type", "notifications"],

    mounted() {
        this.$store.dispatch("loadUsers");
        // this.$store.dispatch("loadNotifications", this.notifications);
        // this.$store.dispatch("currentUser");
        // console.log(this.username);
        // console.log(this.allNotifications);
    },

    data: () => ({
        fab: false,
        hidden: false,
        tabs: null,
        unreadNotifications: [],
        allNotifications: [],
    }),
    created() {
        // -------------pusher realtime---------------
        // Echo.private("App.User." + this.curuser.id).notification(notification => {
        //     console.log(notification, 'new notification on realtime');

        //     this.allNotifications.push(notification.notification)
        // });
        this.allNotifications = this.notifications;

        this.unreadNotifications = this.allNotifications.filter(
            notification => {
                return notification.read_at == null;
            }
        );
    },
    methods: {
        getColor(notification) {
            if (notification.read_at == "null") return "blue-grey";
            else return "#green";
        },
        markAsRead() {
            axios.get("/mark-all-read/" + this.curuser.id).then(Response => {
                this.unreadNotifications = [];
            });
        }
    },
    watch: {
        allNotifications(val) {
            this.unreadNotifications = this.allNotifications.filter(
                notification => {
                    return notification.read_at == null;
                }
            );
        }
    },
    computed: {
        users() {
            return this.$store.state.users;
        },
        curuser() {
            let seluser =
                this.users.find(user => user.name == this.username) || {};
            this.$store.dispatch("currentUser", seluser);
            return seluser;
        },
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        }
    }
};
</script>
