<template>
    <v-container class="my-5">
        <v-card>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <v-col cols="12">
                        <v-row justify="end">
                            <v-spacer></v-spacer>
                            <v-dialog v-model="dialog" max-width="500px">
                                <v-card>
                                    <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.id
                                                        "
                                                        label="Course ID"
                                                        disabled
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="4">
                                                    <v-text-field
                                                        v-model="
                                                            editedItem.course_name
                                                        "
                                                        label="Course Name"
                                                        disabled
                                                    ></v-text-field>
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="close"
                                            >Cancel</v-btn
                                        >
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="save"
                                            >joined</v-btn
                                        >
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-row>
                    </v-col>
                    <h1>Our Labs</h1>
                    <v-toolbar>
                        <!-- <v-tabs background-color="transparent" v-model="tabs">
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
                    > -->
                    </v-toolbar>
                    <v-row dense>
                        <v-col v-for="(item, i) in labs" :key="i" cols="12">
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

                                    <template>
                                        <v-card-actions
                                            v-if="
                                                getEnrollStatus(item.id) ==
                                                    'pending'
                                            "
                                        >
                                            <v-btn class="ma-2" disabled
                                                >pending</v-btn
                                            >
                                            <v-btn class="ma-2">Canceled</v-btn>
                                        </v-card-actions>
                                        <v-card-actions
                                            v-else-if="
                                                getEnrollStatus(item.id) ==
                                                    'joined'
                                            "
                                        >
                                            <v-btn class="ma-2"
                                                >Enter This Labs</v-btn
                                            >
                                        </v-card-actions>
                                        <v-card-actions v-else>
                                            <v-btn
                                                class="ma-2"
                                                @click="editItem(item)"
                                                >Joined This Lab</v-btn
                                            >
                                        </v-card-actions>
                                    </template>
                                </div>
                            </v-card>
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
        this.$store.dispatch("loadEnrolls");
        this.$store.dispatch("loadLabs");
        this.setEditStudentid();
        this.setDefaultStudentid();
    },
    data: () => ({
        dialog: false,
        tabs: null,
        editedIndex: -1,
        editedItem: {
            id: "",
            student_id: "",
            status: ""
        },
        defaultItem: {
            id: "",
            student_id: "",
            status: ""
        }
    }),
    created() {},
    methods: {
        setEditStudentid() {
            this.editItem.student_id = this.curstudent.student.id
            return this.editItem.student_id;
        },
        setDefaultStudentid() {
            this.defaultItem.student_id = this.getStudentId
            return this.defaultItem.student_id;
        },
        getEnrollStatus(labid) {
            let getstatus =
                this.enrolls.find(enroll => enroll.lab_id == labid) || {};
            return getstatus.status;
        },
        getLabName(labid) {
            let getlab = this.labs.find(lab => lab.id == labid) || {};
            return getlab.course_name;
        },
        getProfessorName(labid) {
            let getlab = this.labs.find(lab => lab.id == labid) || {};
            return getlab.professor_name;
        },
        getCourseId(labid) {
            let getlab = this.labs.find(lab => lab.id == labid) || {};
            return getlab.course_id;
        },
        getStudentId() {
            let getstdid = this.users.find(user => user.id == curstudent.id) || {};
            return getstdid.student.id;
        },
        editItem(item) {
            this.editedIndex = this.labs.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },
        save() {
            axios
                .post("/api/enroll/", this.editedItem)
                .then(response => console.log(response.data));
            this.close();
            this.$store.dispatch("loadLabs");
        }
    },
    watch: {
        dialog(val) {
            val || this.close();
        }
    },
    computed: {
        labs() {
            return this.$store.state.labs;
        },
        enrolls() {
            return this.$store.state.enrolls;
        },
        curstudent() {
            return this.$store.state.selectedUser;
        },
        getEnrolllabs() {
            let studentlab =
                this.enrolls.filter(
                    enroll => enroll.student_id == this.curstudent.student.id
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
