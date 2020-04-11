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

                    <v-list three-line class="custom-list">
                        <v-list-item-title
                            v-if="allNotifications.length != 0"
                            class="ml-4 mt-2 headline"
                        >
                            Notifications
                        </v-list-item-title>
                        <p
                            class="ml-2 mr-2"
                            v-if="allNotifications.length == 0"
                        >
                            No notifications.
                        </p>
                        <v-list-item
                            v-for="(notification, i) in allNotifications.slice(
                                0,
                                10
                            )"
                            :key="i"
                        >
                            <v-list-item-avatar>
                                <v-icon>{{
                                    getIcon(
                                        notification.data.NewLendingRequest
                                            .status
                                    )
                                }}</v-icon>
                            </v-list-item-avatar>

                            <v-list-item-content>
                                <v-list-item-title
                                    :class="getBoldTitle(notification.read_at)"
                                    >Request No.
                                    {{ notification.data.NewLendingRequest.id }}
                                    from Lab
                                    {{
                                        notification.data.NewLendingRequest
                                            .lab_id
                                    }}
                                    :
                                    {{
                                        notification.data.NewLendingRequest
                                            .status
                                    }}
                                </v-list-item-title>
                                <v-list-item-subtitle
                                    :class="
                                        getBoldSubtitle(notification.read_at)
                                    "
                                    >12/2/2020 1:14</v-list-item-subtitle
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
        allNotifications: []
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
        getIcon(status) {
            if (status == "ready") return "assignment_turned_in";
            else if (status == "wait") return "hourglass_full";
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
        getBoldTitle(notification) {
            if (notification) return "font-weight-regular";
            else return "font-weight-bold indigo--text";
        },
        getBoldSubtitle(notification) {
            if (notification) return "font-weight-regular";
            else return "font-weight-bold";
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

<style scoped>
.custom-list {
    max-height: 500px;
    overflow: auto;
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
