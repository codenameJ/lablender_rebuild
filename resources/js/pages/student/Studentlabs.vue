<template>
    <v-container class="my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <v-row dense>
                    <v-col cols="12">
                        <v-toolbar class="mb-4"
                            ><v-tabs
                                background-color="transparent"
                                v-model="tabs"
                            >
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
                            ><v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Search"
                                single-line
                                hide-details
                            ></v-text-field></v-toolbar></v-col
                ></v-row>
                <v-row dense>
                    <v-col v-for="(item, i) in filterLab" :key="i" cols="12">
                        <v-card class="mb-1">
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

                                <template>
                                    <v-card-actions
                                        v-if="
                                            getEnrollStatus(item) == 'pending'
                                        "
                                    >
                                        <v-btn class="ma-2" disabled
                                            >pending</v-btn
                                        >
                                        <v-btn
                                            text
                                            color="#757575"
                                            class="ma-2"
                                            @click="canceledenrolled(item)"
                                            >Cancel</v-btn
                                        >
                                    </v-card-actions>
                                    <v-card-actions
                                        v-else-if="
                                            getEnrollStatus(item) == 'joined'
                                        "
                                    >
                                        <v-btn
                                            class="ma-2 elevation-2 no-underline white--text"
                                            color="#1a73e8"
                                            dark
                                            :href="
                                                '/student/lab/' +
                                                    item.course_id +
                                                    '/home'
                                            "
                                            ><v-icon class="mr-2">launch</v-icon>Enter Lab</v-btn
                                        >
                                    </v-card-actions>
                                    <v-card-actions v-else>
                                        <v-btn
                                            outlined
                                            color="indigo"
                                            class="ma-2 elevation-2"
                                            @click="jointhislab(item)"
                                            >Enroll</v-btn
                                        >
                                    </v-card-actions>
                                </template>
                            </div>
                        </v-card>
                    </v-col>
                </v-row>
            </div>
        </div>
    </v-container>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadLabs");
        this.$store.dispatch("loadStudents");
        console.log(this.getstudent);
    },
    data: () => ({
        tabs: null,
        dialog: false,
        search: ""
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
            if (
                confirm(
                    "Are you sure you want to enroll " + item.course_name + "?"
                )
            ) {
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
            if (
                confirm(
                    "Are you sure you want to cancel " +
                        item.course_name +
                        " enrollment?"
                )
            ) {
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
        filterLab: function() {
            return this.alllabs.filter(lab => {
                return lab.course_name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
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
.btn-gradient {
    background-image: linear-gradient(to bottom, #2ad4d9, #2ad4a9);
    font-weight: bold;
}

.blackhref {
    text-decoration: none;
    color: #000000;
}

.whitehref {
    text-decoration: none;
    color: #ffffff;
}

.no-underline {
    text-decoration: none;
}
</style>
