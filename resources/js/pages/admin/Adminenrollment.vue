<template>
    <div id="app">
        <v-container class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <v-col cols="12">
                        <v-row justify="end">
                            <v-spacer></v-spacer>
                        </v-row>
                    </v-col>
                    <v-row dense>
                        <v-toolbar>
                            <v-tabs
                                background-color="transparent"
                                v-model="tabs"
                            ></v-tabs>
                            <v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Search for lab..."
                                single-line
                                hide-details
                            ></v-text-field>
                        </v-toolbar>
                        <v-col cols="12">
                            <div v-for="(item, i) in filterLab" :key="i">
                                <v-card class="my-2">
                                    <div
                                        class="d-flex flex-no-wrap justify-space-between"
                                    >
                                        <div>
                                            <v-card-title
                                                class="headline"
                                                v-text="item.course_name"
                                            ></v-card-title>
                                        </div>
                                    </div>
                                    <v-data-table
                                        class="mt-2"
                                        :headers="student_headers"
                                        :items="item.student"
                                        hide-default-footer
                                    >
                                        <template #item.student_name="{item}">{{
                                            getstudentname(item.user_id)
                                        }}</template>
                                        <template #item.status="{item}">{{
                                            item.pivot.status
                                        }}</template>
                                        <template #item.action="{item}">
                                            <template
                                                v-if="
                                                    item.pivot.status ==
                                                        'pending'
                                                "
                                            >
                                                <v-btn
                                                    small
                                                    outlined
                                                    rounded
                                                    class="elevation-2 mr-2"
                                                    color="success"
                                                    @click="acceptenroll(item)"
                                                >
                                                    <v-icon
                                                        small
                                                        class="mr-2"
                                                        left
                                                        >add_circle_outline</v-icon
                                                    >
                                                    Accept
                                                </v-btn>
                                                <v-btn
                                                    small
                                                    outlined
                                                    rounded
                                                    class="elevation-2"
                                                    color="error"
                                                    @click="
                                                        canceledenrolled(item)
                                                    "
                                                >
                                                    <v-icon
                                                        small
                                                        class="mr-2"
                                                        left
                                                        >remove_circle_outline</v-icon
                                                    >
                                                    Decline
                                                </v-btn>
                                            </template>
                                            <template v-else>
                                                <v-btn
                                                    small
                                                    outlined
                                                    rounded
                                                    class="elevation-2"
                                                    color="error"
                                                    @click="
                                                        canceledenrolled(item)
                                                    "
                                                >
                                                    <v-icon
                                                        small
                                                        class="mr-2"
                                                        left
                                                        >remove_circle_outline</v-icon
                                                    >
                                                    Remove
                                                </v-btn>
                                            </template>
                                        </template>
                                    </v-data-table>
                                </v-card>
                            </div>
                        </v-col>
                    </v-row>
                </div>
            </div>
        </v-container>
    </div>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("loadLabs");
    },
    data: () => ({
        search: "",
        search_student: "",
        tabs: null,
        student_headers: [
            { text: "Student ID", value: "student_id" },
            { text: "Student Name", value: "student_name", sortable: false },
            { text: "Status", value: "status" },
            { text: "Action", value: "action", sortable: false }
        ]
    }),
    created() {},
    methods: {
        getstudentname(userid) {
            let stdname = this.users.find(user => user.id == userid) || {};
            return stdname.name;
        },
        canceledenrolled(item) {
            if (
                confirm(
                    "Are you sure you want to cancel " +
                        item.student_id +
                        " enrollment?"
                )
            ) {
                axios
                    .put("/api/enroll/" + item.pivot.lab_id, {
                        student_id: item.pivot.student_id,
                        lab_id: item.pivot.lab_id,
                        cmd: "cancel"
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadLabs");
            }
        },
        acceptenroll(item) {
            if (
                confirm(
                    "Are you sure you want to accept " +
                        item.student_id +
                        " enrollment?"
                )
            ) {
                axios
                    .put("/api/enroll/" + item.pivot.lab_id, {
                        student_id: item.pivot.student_id,
                        lab_id: item.pivot.lab_id,
                        cmd: "accept"
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadLabs");
            }
        }
    },
    computed: {
        users() {
            return this.$store.state.users;
        },
        labs() {
            return this.$store.state.labs;
        },
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        },
        filterLab: function() {
            return this.labs.filter(lab => {
                return lab.course_name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
    },
    watch: {}
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
