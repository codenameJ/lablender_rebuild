<template>
    <v-content>
        <v-container class="my-5">
            <div class="row justify-content-center">
                <div class="col-12">
                    <v-row dense>
                        <v-col cols="12">
                            <v-toolbar>
                                <v-text-field
                                    v-model="search"
                                    append-icon="search"
                                    label="Search"
                                    single-line
                                    hide-details
                                ></v-text-field>
                            </v-toolbar>
                        </v-col>
                    </v-row>

                    <template>
                        <v-tabs
                            fixed-tabs
                            color="#1a73e8"
                            background-color="white"
                            class="mt-3 mb-1"
                        >
                            <v-tab @click="setcomp('allstdlist')">
                                All
                            </v-tab>
                            <v-tab @click="setcomp('waitstdlist')">
                                Wait
                            </v-tab>
                            <v-tab @click="setcomp('readystdlist')">
                                Ready
                            </v-tab>
                            <v-tab @click="setcomp('receivestdlist')">
                                receive
                            </v-tab>
                        </v-tabs>
                    </template>
                    <allstdlist v-if="currentComp == 'allstdlist'" />
                    <waitstdlist v-if="currentComp == 'waitstdlist'" />
                    <readystdlist v-if="currentComp == 'readystdlist'" />
                    <receivestdlist v-if="currentComp == 'receivestdlist'" />
                </div>
            </div>
        </v-container>
    </v-content>
</template>

<script>
import allstdlist from "./studentrequestcomponent/all.vue";
import waitstdlist from "./studentrequestcomponent/wait.vue";
import readystdlist from "./studentrequestcomponent/ready.vue";
import receivestdlist from "./studentrequestcomponent/receive.vue";
export default {
    components: {
        allstdlist: allstdlist,
        waitstdlist: waitstdlist,
        readystdlist: readystdlist,
        receivestdlist: receivestdlist
    },
    mounted() {
        this.$store.dispatch("loadRequest_lists");
    },
    data: () => ({
        currentComp: "allstdlist",
        dialog: false,
        search: "",
        detail_headers: [
            { text: "Detail ID", value: "id" },
            { text: "Equipment ID", value: "equipment_id" },
            { text: "Equipment Name", value: "equipment_name" },
            { text: "Len Qty", value: "len_qty" }
        ],
        editedIndex: -1
    }),
    created() {},
    methods: {
        setcomp(compname) {
            this.currentComp = compname;
        },
        getColor(status) {
            if (status == "wait") return "blue-grey";
            else if (status == "ready") return "green";
            else if (status == "broken") return "red";
            else if (status == "missing") return "orange accent-2";
            else return "#CE93D8";
        }
    },
    computed: {
        currentuser() {
            return this.$store.state.selectedUser;
        },
        curlab() {
            return this.$store.state.selectedLab;
        },
        filterRequestlists: function() {
            return this.StudentRequest.filter(requestlist => {
                return requestlist.student_id
                    .toLowerCase()
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
