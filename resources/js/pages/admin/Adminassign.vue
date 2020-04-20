<template>
    <div id="app" v-if="curprof">
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
                                <v-card class="mt-2 mb-5">
                                    <v-card-actions>
                                        <v-card-title
                                            class="headline"
                                            v-text="item.course_name"
                                        >
                                        </v-card-title>
                                        <v-spacer></v-spacer>
                                        <v-dialog
                                            v-model="dialog"
                                            max-width="500px"
                                            :retain-focus="false"
                                        >
                                            <template v-slot:activator="{ on }">
                                                <v-btn
                                                    color="primary"
                                                    outlined
                                                    class="mb-2 mr-2"
                                                    v-on="on"
                                                    @click="setLab(item)"
                                                    ><v-icon class="mr-2"
                                                        >add</v-icon
                                                    >Add TA</v-btn
                                                >
                                            </template>

                                            <v-card>
                                                <v-card-title>
                                                    <span class="headline"
                                                        >Add TA</span
                                                    >
                                                </v-card-title>
                                                <v-data-table
                                                    class="mt-2"
                                                    :headers="user_headers"
                                                    :items="unassign"
                                                    hide-default-footer
                                                >
                                                    <template
                                                        v-slot:item.action="{
                                                            item
                                                        }"
                                                    >
                                                        <v-btn
                                                            color="blue darken-1"
                                                            text
                                                            @click="
                                                                assign(item)
                                                            "
                                                            :disabled="
                                                                alradyadd.includes(
                                                                    item.ta.id
                                                                )
                                                            "
                                                            >ADD</v-btn
                                                        >
                                                    </template>
                                                </v-data-table>
                                            </v-card>
                                        </v-dialog>
                                    </v-card-actions>
                                    <v-data-table
                                        class="mt-2"
                                        :headers="student_headers"
                                        :items="item.ta"
                                        hide-default-footer
                                    >
                                        <template #item.ta_name="{item}">{{
                                            gettaname(item.user_id)
                                        }}</template>
                                        <template #item.status="{item}">{{
                                            item.pivot.status
                                        }}</template>
                                        <template #item.action="{item}">
                                            <v-btn
                                                small
                                                outlined
                                                rounded
                                                class="elevation-2"
                                                color="error"
                                                @click="cancelassign(item)"
                                            >
                                                <v-icon small class="mr-2" left
                                                    >remove_circle_outline</v-icon
                                                >
                                                Remove
                                            </v-btn>
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
        this.$store.dispatch("loadTas");
        this.$store.dispatch("loadUsers");
    },
    data: () => ({
        dialog: false,
        search: "",
        tabs: null,
        alradyadd: [],
        student_headers: [
            { text: "TA Name", value: "ta_name", sortable: false },
            { text: "Action", value: "action", sortable: false }
        ],
        user_headers: [
            { text: "id", value: "id", sortable: false },
            { text: "Name", value: "name", sortable: false },
            { text: "type", value: "type", sortable: false },
            { text: "Action", value: "action", sortable: false }
        ],
        getlabid: null,
        tainlab: []
    }),
    created() {},
    methods: {
        setLab(item) {
            this.getlabid = item.id;
            this.tainlab = item.ta;
            console.log(this.tainlab);
        },
        close() {
            this.alradyadd = [],
            this.dialog = false;
        },
        gettaname(userid) {
            let taname = this.users.find(user => user.id == userid) || {};
            return taname.name;
        },
        cancelassign(item) {
            if (confirm("Are you sure you want to cancel enrollment?")) {
                axios
                    .put("/api/assign/" + item.pivot.lab_id, {
                        ta_id: item.pivot.ta_id,
                        lab_id: item.pivot.lab_id,
                        cmd: "cancel"
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadLabs");
                this.alradyadd = [];
            }
        },
        assign(item) {
            const index = this.unassign.indexOf(item);
            console.log(index);
            if (confirm("Are you sure you want to accept enrollment?")) {
                axios
                    .put("/api/assign/" + this.getlabid, {
                        ta_id: item.ta.id,
                        lab_id: this.getlabid,
                        cmd: "assign"
                    })
                    .then(response => console.log(response.data));
                this.$store.dispatch("loadLabs");
                this.unassign.splice(index, 1);
                this.alradyadd.push(item.ta.id);
            }
            console.log(this.unassign);
        },
        comparer(otherArray) {
            return function(current) {
                return (
                    otherArray.filter(function(other) {
                        return (
                            other.user_id == current.id
                            // && other.display == current.display
                        );
                    }).length == 0
                );
            };
        },
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
        curprof() {
            return this.$store.state.selectedUser;
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
        filterTa: function() {
            return this.users.filter(user => {
                return user.type == "ta";
            });
        },
        unassign: function() {
            this.alradyadd = [];
            // console.log(this.tainlab)
            // console.log(this.filterTa)
            // return this.filterTa.filter(this.comparer(this.tainlab));
            // return this.tainlab.filter(this.comparer(this.filterTa));
            const result = this.filterTa.filter(({
                id
            }) => this.tas.some(x => x.user_id == id))
            // console.log(result)
            return result;
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
