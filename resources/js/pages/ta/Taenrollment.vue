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
                        <v-toolbar
                            ><v-tabs
                                background-color="transparent"
                                v-model="tabs"
                            >
                                <v-tab style="text-decoration : none;" to=""
                                    >All</v-tab
                                >
                                <v-tabs-slider color="white"></v-tabs-slider>
                            </v-tabs>
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

                                    <table class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width:25%">Student ID</th>
                                                <th style="width:25%">Student Name</th>
                                                <th style="width:25%">Status</th>
                                                <th style="width:25%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(std, i) in item.student"
                                                :key="i"
                                            >
                                                <td>
                                                    {{ std.student_id }}
                                                </td>
                                                <td>
                                                    {{
                                                        getstudentname(
                                                            std.user_id
                                                        )
                                                    }}
                                                </td>
                                                <td>
                                                    {{ std.pivot.status }}
                                                </td>
                                                <td
                                                    v-if="
                                                        std.pivot.status ==
                                                            'pending'
                                                    "
                                                >
                                                    <v-btn
                                                        small
                                                        outlined
                                                        rounded
                                                        class="elevation-2 mr-2"
                                                        color="success"
                                                        @click="acceptenroll(item,std)"
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
                                                            canceledenrolled(
                                                                item,
                                                                std
                                                            )
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
                                                </td>
                                                <td v-else>
                                                    <v-btn
                                                        small
                                                        outlined
                                                        rounded
                                                        class="elevation-2"
                                                        color="error"
                                                        @click="
                                                            canceledenrolled(
                                                                item,
                                                                std
                                                            )
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
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
        tabs: null,
        student_headers: [{ text: "Student ID", value: "student_id" }]
    }),
    created() {},
    methods: {
        getstudentname(userid) {
            let stdname = this.users.find(user => user.id == userid) || {};
            return stdname.name;
        },
        canceledenrolled(item, std) {
            if (confirm("Are you sure you want to cancel " + std.student_id + " enrollment?")) {
                axios
                    .put("/api/enroll/" + item.id, {
                        student_id: std.id,
                        lab_id: item.id,
                        cmd: 'cancel'
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadLabs");
            }
        },
        acceptenroll(item, std){
                        if (confirm("Are you sure you want to accept " + std.student_id + " enrollment?")) {
                axios
                    .put("/api/enroll/" + item.id, {
                        student_id: std.id,
                        lab_id: item.id,
                        cmd: 'accept'
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
        tas() {
            return this.$store.state.tas;
        },
        currentuser() {
            return this.$store.state.selectedUser;
        },
        getta() {
            let talab =
                this.tas.filter(ta => ta.id == this.currentuser.ta.id) || {};
            return talab;
        },
        activeFab() {
            switch (this.tabs) {
                default:
                    return {};
            }
        },
        filterLab: function() {
            return this.labs.filter(lab => {
                return lab.course_name.toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        }
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
