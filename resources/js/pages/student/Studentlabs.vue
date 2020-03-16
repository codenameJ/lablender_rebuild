<template>
    <v-container class="my-5">
        <v-card>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <h1>Our Labs</h1>
                    <v-toolbar
                        ><v-tabs background-color="transparent" v-model="tabs">
                            <v-tab style="text-decoration : none;" to=""
                                >All</v-tab
                            >
                            <v-tab style="text-decoration : none;" to=""
                                >Enrolled</v-tab
                            >
                            <v-tab style="text-decoration : none;" to=""
                                >Pending</v-tab
                            >
                            <v-tabs-slider
                                color="white"
                            ></v-tabs-slider> </v-tabs
                    ></v-toolbar>
                    <v-row dense>
                        <v-col v-for="(item, i) in alllabs" :key="i" cols="12">
                            <!-- <div v-for="(lab, i) in item.labs" :key="i"> -->
                            <v-card>
                                <div
                                    class="d-flex flex-no-wrap justify-space-between"
                                >
                                    <div>
                                        <v-card-title
                                            class="headline"
                                            v-text="item.course_name"
                                        ></v-card-title>

                                        <v-card-subtitle
                                            v-text="item.professor_name"
                                        ></v-card-subtitle>
                                    </div>

                                    <!-- <v-card-actions>
                                            <v-btn
                                                class="ma-2"
                                                :href="
                                                    '/student/lab/' + item.course_id
                                                "
                                                >Enter This Lab</v-btn
                                            >
                                        </v-card-actions> -->
                                    <template>
                                        <v-card-actions
                                            v-if="
                                                getEnrollStatus(item) ==
                                                    'pending'
                                            "
                                        >
                                            <v-btn class="ma-2" disabled
                                                >pending</v-btn
                                            >
                                            <v-btn
                                                class="ma-2"
                                                @click="canceledenrolled(item)"
                                                >Canceled</v-btn
                                            >
                                        </v-card-actions>
                                        <v-card-actions
                                            v-else-if="
                                                getEnrollStatus(item) ==
                                                    'joined'
                                            "
                                        >
                                            <v-btn
                                                class="ma-2"
                                                dark
                                                :href="
                                                    '/student/lab/' +
                                                        item.course_id + '/home'
                                                "
                                                >Enter This Labs</v-btn
                                            >
                                        </v-card-actions>
                                        <v-card-actions v-else>
                                            <v-btn
                                                class="ma-2"
                                                @click="jointhislab(item)"
                                                >Joined This Lab</v-btn
                                            >
                                        </v-card-actions>
                                    </template>
                                </div>
                            </v-card>
                            <!-- </div> -->
                        </v-col>
                    </v-row>
                </div>
            </div>
        </v-card>
    </v-container>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadLabs");
        this.$store.dispatch("loadStudents");
        // console.log(this.getstudent.labs)
    },
    data: () => ({
        tabs: null,
        dialog: false
    }),
    created() {},
    methods: {
        getEnrollStatus(item) {
            let stdlab = this.getstudent.labs;
            // console.log(stdlab);
            for (let i = 0; i < stdlab.length; i++) {
                if (stdlab[i].id == item.id) {
                    // console.log(stdlab[i].pivot.status);
                    return stdlab[i].pivot.status;
                }
            }
        },
        jointhislab(item) {
            if (confirm("Are you sure you want to join this Lab?")) {
                axios
                    .post("/api/student", {
                        student_id: this.currentuser.student.id,
                        lab_id: item.id
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadLabs");
                this.$store.dispatch("loadStudents");
            }
        },
        canceledenrolled(item) {
            if (confirm("Are you sure you want to canceled this enrolled?")) {
                axios
                    .put("/api/student/" + item.id, {
                        student_id: this.currentuser.student.id,
                        lab_id: item.id
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadLabs");
                this.$store.dispatch("loadStudents");
            }
        }
    },
    computed: {
        alllabs() {
            return this.$store.state.labs;
        },
        students() {
            return this.$store.state.students;
        },
        currentuser() {
            return this.$store.state.selectedUser;
        },
        getstudent() {
            let studentlab =
                this.students.find(
                    std => std.id == this.currentuser.student.id
                ) || {};
            return studentlab;
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
