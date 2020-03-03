<template>
    <div id="app">
        <nav>
            <v-toolbar flat>
                <v-app-bar-nav-icon
                    @click="drawer = !drawer"
                ></v-app-bar-nav-icon>
                <v-toolbar-title>Lab Lender</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon>
                    <v-icon>notifications</v-icon>
                </v-btn>

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

                        <v-divider></v-divider>

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
            </v-toolbar>

            <v-navigation-drawer
                app
                v-model="drawer"
                class="background-gradient"
                src="/img/nav1.png"
                overlay-opacity="70"
                absolute
                dark
            >
                <v-list-item>
                    <v-img
                        class="mt-3"
                        src="/img/icon.png"
                        max-width="50"
                        max-height="50"
                    >
                    </v-img>
                    <div
                        class="mx-4 pt-3 font-weight-bold"
                        style="font-size:1.5em"
                    >
                        LAB LENDER
                        {{ course_id }}
                    </div>
                </v-list-item>
                <v-divider></v-divider>

                <v-list nav dense v-if="type == 'admin'">
                    <v-list-item link @click="$router.push('/admin/lab/' + course_id)">
                        <v-list-item-action>
                            <v-icon class="ml-2">mdi-home</v-icon>
                        </v-list-item-action>
                        
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/admin/lab/' + course_id"
                                    >หน้าหลัก</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push( '/admin/lab/' +
                                            course_id +
                                            '/announcement')">
                        <v-list-item-action>
                            <v-icon class="ml-2">announcement</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="
                                        '/admin/lab/' +
                                            course_id +
                                            '/announcement'
                                    "
                                    >ประกาศ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/admin/lab/' + course_id + '/equipment')">
                        <v-list-item-action>
                            <v-icon class="ml-2">build</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="
                                        '/admin/lab/' + course_id + '/equipment'
                                    "
                                    >อุปกรณ์</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/admin/lab/' + course_id + '/request')">
                        <v-list-item-action>
                            <v-icon class="ml-2">assignment</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/admin/lab/' + course_id + '/request'"
                                    >คำขอยืม</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/admin/lab/' + course_id + '/history')">
                        <v-list-item-action>
                            <v-icon class="ml-2">history</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/admin/lab/' + course_id + '/history'"
                                    >ประวัติ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-group no-action>
                        <v-list-item slot="activator">
                            <v-list-item-action>
                                <v-icon>account_circle</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title
                                    >จัดการผู้ใช้</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item link @click="$router.push('/admin/lab/' + course_id + '/user')">
                            <v-list-item-content>
                                <v-list-item-title>
                                    <router-link
                                        class="menuhref ml-2"
                                        :to="
                                            '/admin/lab/' + course_id + '/user'
                                        "
                                        >ผู้ใช้งานทั้งหมด</router-link
                                    ></v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item link @click="$router.push('/admin/lab/' + course_id + '/ta')">
                            <v-list-item-content>
                                <v-list-item-title>
                                    <router-link
                                        class="menuhref ml-2"
                                        :to="'/admin/lab/' + course_id + '/ta'"
                                        >ผู้ช่วยสอน</router-link
                                    ></v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>

                        <v-list-item link @click="$router.push('/admin/lab/' + course_id + '/student')">
                            <v-list-item-content>
                                <v-list-item-title>
                                    <router-link
                                        class="menuhref ml-2"
                                        :to="
                                            '/admin/lab/' +
                                                course_id +
                                                '/student'
                                        "
                                        >นักศึกษา</router-link
                                    ></v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-group>
                </v-list>

                <v-list nav dense v-if="type == 'professor'">
                    <v-list-item link @click="$router.push('/professor/lab/' + course_id)">
                        <v-list-item-action>
                            <v-icon class="ml-2">mdi-home</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/professor/lab/' + course_id"
                                    >หน้าหลัก</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/professor/lab/' + course_id + '/announcement')">
                        <v-list-item-action>
                            <v-icon class="ml-2">announcement</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="
                                        '/professor/lab/' +
                                            course_id +
                                            '/announcement'
                                    "
                                    >ประกาศ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/professor/lab/' + course_id + '/equipment')">
                        <v-list-item-action>
                            <v-icon class="ml-2">build</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="
                                        '/professor/lab/' +
                                            course_id +
                                            '/equipment'
                                    "
                                    >อุปกรณ์</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/professor/lab/' + course_id + '/request')">
                        <v-list-item-action>
                            <v-icon class="ml-2">assignment</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="
                                        '/professor/lab/' +
                                            course_id +
                                            '/request'
                                    "
                                    >คำขอยืม</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/professor/lab/' + course_id + '/history')">
                        <v-list-item-action>
                            <v-icon class="ml-2">history</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="
                                        '/professor/lab/' +
                                            course_id +
                                            '/history'
                                    "
                                    >ประวัติ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

                <v-list nav dense v-if="type == 'ta'">
                    <v-list-item link @click="$router.push('/ta/lab/' + course_id)">
                        <v-list-item-action>
                            <v-icon class="ml-2">mdi-home</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/ta/lab/' + course_id"
                                    >หน้าหลัก</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/ta/lab/' + course_id + '/announcement')">
                        <v-list-item-action>
                            <v-icon class="ml-2">announcement</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="
                                        '/ta/lab/' + course_id + '/announcement'
                                    "
                                    >ประกาศ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/ta/lab/' + course_id + '/equipment')">
                        <v-list-item-action>
                            <v-icon class="ml-2">build</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/ta/lab/' + course_id + '/equipment'"
                                    >อุปกรณ์</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/ta/lab/' + course_id + '/request')">
                        <v-list-item-action>
                            <v-icon class="ml-2">assignment</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/ta/lab/' + course_id + '/request'"
                                    >คำขอยืม</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/ta/lab/' + course_id + '/history')">
                        <v-list-item-action>
                            <v-icon class="ml-2">history</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/ta/lab/' + course_id + '/history'"
                                    >ประวัติ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

                <v-list nav dense v-if="type == 'student'">
                    <v-list-item link @click="$router.push('/lab/' + course_id)">
                        <v-list-item-action>
                            <v-icon class="ml-2">mdi-home</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/lab/' + course_id"
                                    >หน้าหลัก</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/lab/' + course_id + '/announcement')">
                        <v-list-item-action>
                            <v-icon class="ml-2">announcement</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/lab/' + course_id + '/announcement'"
                                    >ประกาศ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/lab/' + course_id + '/equipment')">
                        <v-list-item-action>
                            <v-icon class="ml-2">build</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/lab/' + course_id + '/equipment'"
                                    >อุปกรณ์</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/lab/' + course_id + '/request')">
                        <v-list-item-action>
                            <v-icon class="ml-2">assignment</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/lab/' + course_id + '/request'"
                                    >คำขอยืม</router-link
                                >
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-list-item link @click="$router.push('/lab/' + course_id + '/history')">
                        <v-list-item-action>
                            <v-icon class="ml-2">history</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                <router-link
                                    class="menuhref"
                                    :to="'/lab/' + course_id + '/history'"
                                    >ประวัติ</router-link
                                ></v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>
        </nav>
    </div>
</template>

<script>
export default {
    props: ["username", "type", "course_id"],

    created() {},
    mounted() {
        console.log(this.username);
        console.log(this.course_id);
    },
    name: "Header",
    components: {},
    data: () => ({
        post: null,
        error: null,
        appName: process.env.APP_NAME,
        fixed: false,
        dialog: false,
        drawer: true
    }),

    beforeRouteEnter(to, from, next) {
        getPost(to.params.id, (err, post) => {
            next(vm => vm.setData(err, post));
        });
    },

    beforeRouteUpdate(to, from, next) {
        this.post = null;
        getPost(to.params.id, (err, post) => {
            this.setData(err, post);
            next();
        });
    },

    computed: {
        isMobile() {
            return window.innerWidth < 600;
        }
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        $route(to, from) {}
    },

    methods: {
        sidebarToggle() {
            this.drawer = !this.drawer;
        },
        checkMobile() {
            console.log("ttt");
            if (this.isMobile) {
                this.drawer = false;
            }
        },

        setData(err, post) {
            if (err) {
                this.error = err.toString();
            } else {
                this.post = post;
            }
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
</style>
